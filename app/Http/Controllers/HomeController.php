<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkoutType;
use App\Workout;
use App\FoodType;
use App\Food;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $user = auth()->user();

    //Get all user's targets
    $targets = $user->targets->all();

    /**
     * Data for the Weight Index Chart
     */
    $weight = $user->weights->last()->weight;
    $pheight = pow($user->height / 100, 2);
    $weight_borders = [
      'green_low' => round(18.5 * $pheight),
      'green' => round(25 * $pheight),
      'yellow' => round(30 * $pheight),
      'red' => round(40 * $pheight)
    ];

    /**
     * Data for Mood Index
     */
    $mood = $user->moods->last()->mood;

    /**
     * Data for Activities Proportion chart
     */
    $temp = $user->workouts->countBy('workout_type_id');
    $workouts = [["Activity", "Count"]];
    foreach ($temp as $workout_id => $count) {
      $workout = WorkoutType::find($workout_id)->name;
      array_push($workouts, [$workout, $count]);
    }

    /**
     * Data for Activities Comparison chart
     */
    $date = new \DateTime('now');
    $now = new \DateTime('now');
    $date->modify('-14 days');
    $activities = [["Days", "Average time", "Your time"]];
    $activities_sum = 0;
    while ($date <= $now) {
      $average = round(Workout::where('date', $date->format('Y-m-d'))->whereNotIn('user_id', [$user->id])->avg('duration'));
      $my = round($user->workouts->where('date', $date->format('Y-m-d'))->avg('duration'));
      $activities_sum += $my;
      array_push($activities, [$date->format('d.m'), $average, $my]);
      $date->modify('+1 day');
    }

    /**
     * Data for Excessive Calories Consumption chart
     */
    $date = new \DateTime('now');
    $now = new \DateTime('now');
    $date->modify('-7 days');
    $calories = [["Days", "Junk Food", "Alcohol"]];
    $alcohols = FoodType::where('is_alcohol', '1')->pluck('id');
    $calories_sum = 0;
    $drinks_sum = 0;
    while ($date <= $now) {
      $alcohol = $user->foods->where('date', $date->format('Y-m-d'))->whereIn('food_type_id', $alcohols)->sum('calories');
      $food = $user->foods->where('date', $date->format('Y-m-d'))->whereNotIn('food_type_id', $alcohols)->sum('calories');
      $drinks_sum += $user->foods->where('date', $date->format('Y-m-d'))->whereIn('food_type_id', $alcohols)->sum('drinks');
      $calories_sum += $alcohol + $food;
      array_push($calories, [$date->format('d.m'), $alcohol, $food]);
      $date->modify('+1 day');
    }

    /**
     * Data for Sleep Index chart
     */
    $date = new \DateTime('now');
    $date->modify('-7 days');
    $sleep = $user->sleeps->where('date', '>=', $date->format('Y-m-d'))->avg('minutes') / 60;

    /**
     * Coach messages
     */
    $coach_motd = [];
    if ($activities_sum > 120) {
      array_push($coach_motd, ["You've done well this week. Dwayne envy your results!!!", "alert-success"]);
    }
    if ($calories_sum > 3000) {
      array_push($coach_motd, ["If you eat too much junk food you will never look like me.", "alert-warning"]);
    }
    if ($mood < 3) {
      array_push($coach_motd, ["Don't take it too seriously. Cheer up!", "alert-warning"]);
    }
    if ($drinks_sum > 13) {
      array_push($coach_motd, ["You drink too much. Wanna talk about it?", "alert-danger"]);
    }

    return view('home', compact('weight', 'mood', 'targets', 'sleep', 'coach_motd'))
      ->with('weight_borders', json_encode($weight_borders))
      ->with('workouts', json_encode($workouts))
      ->with('activities', json_encode($activities))
      ->with('calories', json_encode($calories));
  }

  public function types()
  {
    $user = auth()->user();
    $workout_types = \App\WorkoutType::all();
    $food_types = \App\FoodType::all();
    return view('typesview', compact('workout_types', 'food_types'));
  }

  public function calendar()
  {
    $user = auth()->user();
    $workouts = $user->workouts;
    $foods = $user->foods;
    $events = [];
    if ($workouts->count()) {
      foreach ($workouts as $workout) {
        $events[] = \Calendar::event(
          $workout->workout_type->name . ": " . $workout->duration . " min",
          true,
          new \DateTime($workout->date),
          null,
          null,
          [
            'color' => $workout->workout_type->color,
            'textColor' => 'white',
          ]
        );
      }
    }
    if ($foods->count()) {
      foreach ($foods as $food) {
        $color = ($food->food_type->is_alcohol? '#B7392D' : '#16171B');
        $events[] = \Calendar::event(
          $food->food_type->name . ": " . $food->calories . " cal",
          true,
          new \DateTime($food->date),
          null,
          null,
          [
            'color' => $color,
            'textColor' => 'white',
          ]
        );
      }
    }
    $calendar = \Calendar::addEvents($events);
    return view('calendar', compact('calendar'));
  }

  public function recordAdd()
  {
    $workout_types = WorkoutType::all();
    $food_types = FoodType::all();
    return view('recordadd', compact('workout_types', 'food_types'));
  }

  public function stats() {
    $user = auth()->user();
    $now = new \DateTime('now');
    $totals = [];
    $records = [];
    $workouts = $user->workouts();
    $totals['distance'] = $workouts->sum('distance') / 1000;
    $totals['count'] = $workouts->count();
    $totals['calories'] = $workouts->sum('calories');
    $totals['duration'] = round($workouts->sum('duration') / 60);

    $records ['consumed'] = $user->foods->sum('calories');
    $records ['longestWorkout'] = 0;
    $records ['daysInRow'] = 0;
    $records['longestWorkout'] = $workouts->max('duration');
    $daysInRow = 0;
    $currentDay = new \DateTime($workouts->first()->date);
    while($currentDay <= $now) {
      $duration = $workouts->where('date', $currentDay)->sum('duration');
      $daysInRow = $duration !== 0 ? $daysInRow + 1 : 0;
      $records['daysInRow'] = $records['daysInRow'] < $daysInRow ? $daysInRow : $records['daysInRow'];
      $currentDay->modify('+1 day');
    }

    $workouts = $user->workouts->groupBy('workout_type_id');
    $stats = [];
    foreach($workouts as $workout_id => $workoutcoll) {
      $name = WorkoutType::find($workout_id)->name;
      $count = $workoutcoll->count();
      $distance = $workoutcoll->sum('distance') / 1000;
      $duration = round($workoutcoll->sum('duration') / 60);
      $burnt = round($workoutcoll->sum('calories'));
      $stats[$name] = ['count' => $count, 'distance' => $distance, 'duration' => $duration, 'burnt' => $burnt];
    }
    return view('stats', compact('totals', 'stats', 'records'));
  }

}
