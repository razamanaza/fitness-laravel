<?php

namespace App\Http\Controllers;

use App\WorkoutType;
use App\Workout;
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
      'distance' => ['nullable', 'numeric'],
      'calories' => ['required', 'numeric'],
    ]);
    $temp = request()->validate([
      'duration-hh' => ['nullable','numeric'],
      'duration-mm' => ['required', 'numeric', 'between:0,60'],
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
    return redirect('/home');
  }
}
