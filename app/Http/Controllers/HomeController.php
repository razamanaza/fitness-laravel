<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkoutType;
use App\Workout;

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

    //Data for Weight Index Chart
    $weight = $user->weights->last()->weight;
    $pheight = pow($user->height / 100, 2);
    $weight_borders = [
      'green_low' => round(18.5 * $pheight),
      'green' => round(25 * $pheight),
      'yellow' => round(30 * $pheight),
      'red' => round(40 * $pheight)
    ];

    //Data for Mood Index
    $mood = $user->moods->last()->mood;

    //Data for activityChart
    $temp = $user->workouts->countBy('workout_type_id');
    $workouts = [["Activity", "Count"]];
    foreach ($temp as $workout_id => $count) {
      $workout = WorkoutType::find($workout_id)->name;
      array_push($workouts, [$workout, $count]);
    }

    //Data for activitiesByDays
    $now = new \DateTime('now');
    $date = new \DateTime('now');
    $date->modify('-7 days');
    $activities = [["Days", "Average time", "Your time"]];
    while ($date < $now) {
      $average = round(Workout::where('date', $date->format('Y-m-d'))->whereNotIn('user_id', [$user->id])->avg('duration'));
      $my = round($user->workouts->where('date', $date->format('Y-m-d'))->avg('duration'));
      array_push($activities, [$date->format('d.m'), $average, $my]);
      $date->modify('+1 day');
    }

    //Data for caloriesTrend
    $now = new \DateTime('now');
    $date = new \DateTime('now');
    $date->modify('-30 days');
    $calories = [["Days", "Junk Food", "Alcohol"]];
    while ($date < $now) {
      $average = round(Workout::where('date', $date->format('Y-m-d'))->whereNotIn('user_id', [$user->id])->avg('duration'));
      $my = round($user->workouts->where('date', $date->format('Y-m-d'))->avg('duration'));
      array_push($activities, [$date->format('d.m'), $average, $my]);
      $date->modify('+1 day');
    }

    return view('home', compact('weight', 'mood'))
      ->with('weight_borders', json_encode($weight_borders))
      ->with('workouts', json_encode($workouts))
      ->with('activities', json_encode($activities))
      ->with('activities', json_encode($calories));
  }
}
