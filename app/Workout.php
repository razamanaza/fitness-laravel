<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = [
        'date', 'workout_type_id', 'distance', 'duration', 'calories', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function workout_type()
    {
        return $this->belongsTo('App\WorkoutType');
    }
}
