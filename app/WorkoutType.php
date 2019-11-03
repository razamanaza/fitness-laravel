<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkoutType extends Model
{
    protected $fillable = [
        'name', 'has_distance'
    ];

    public function workouts()
    {
        return $this->hasMany('App\Workout');
    }
}
