<?php

namespace App\Http\Controllers;

use App\WorkoutType;
use App\Workout;
use App\FoodType;
use App\Food;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RecordController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function workout(Request $request) {
    $data = request()->validate([
      'date' => ['required', 'date'],
      'workout_type_id' => ['required', 'integer', Rule::in(WorkoutType::all()->pluck('id'))],
      'distance' => ['nullable', 'integer'],
      'calories' => ['required', 'integer'],
    ]);
    $temp = request()->validate([
      'duration-hh' => ['nullable','integer'],
      'duration-mm' => ['required', 'integer', 'between:0,60'],
    ]);
    $data['user_id'] = auth()->user()->id;
    $data['duration'] = $temp['duration-hh'] * 60 + $temp['duration-mm'];
    if ($request->denomination != 'calories') {
      $data['calories'] = round($data['calories'] / 4,184);
    }
    if(!$data['distance']) {
      $data['distance'] = 0;
    }
    Workout::create($data);
    return redirect('/success');
  }

  public function food(Request $request) {
    $data = request()->validate([
      'date' => ['required', 'date'],
      'food_type_id' => ['required', 'integer', Rule::in(FoodType::all()->pluck('id'))],
      'drinks' => ['nullable', 'numeric'],
      'calories' => ['required', 'integer'],
    ]);
    $data['user_id'] = auth()->user()->id;
    if(!$data['drinks']) {
      $data['drinks'] = 0;
    }
    Food::create($data);
    return redirect('/success');
  }

  public function sleep(Request $request) {
    $data = request()->validate([
      'date' => ['required', 'date'],
    ]);
    $temp = request()->validate([
      'other_type' => ['required', 'alpha'],
      'amount' => ['nullable', 'numeric'],
    ]);
    $data['user_id'] = auth()->user()->id;
    $data['minutes'] = $request->amount;
    \App\Sleep::create($data);
    return redirect('/success');
  }

  public function mood(Request $request) {
    $data = request()->validate([
      'date' => ['required', 'date'],
    ]);
    $temp = request()->validate([
      'other_type' => ['required', 'alpha'],
      'amount' => ['nullable', 'integer', 'between:1,10'],
    ]);
    $data['user_id'] = auth()->user()->id;
    $data['mood'] = $request->amount;
    \App\Mood::create($data);
    return redirect('/success');
  }

  public function weight(Request $request) {
    $data = request()->validate([
      'date' => ['required', 'date'],
    ]);
    $temp = request()->validate([
      'other_type' => ['required', 'alpha'],
      'amount' => ['nullable', 'numeric'],
    ]);
    $data['user_id'] = auth()->user()->id;
    $data['weight'] = $request->amount;
    \App\Weight::create($data);
    return redirect('/success');
  }
}
