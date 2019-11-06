<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkoutType extends Model
{
  protected $fillable = [
    'name', 'has_distance', 'color'
  ];

  public function workouts()
  {
    return $this->hasMany('App\Workout');
  }
}
