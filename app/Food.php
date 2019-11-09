<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'date', 'food_type_id', 'drinks', 'calories', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function food_type()
    {
        return $this->belongsTo('App\FoodType');
    }
}
