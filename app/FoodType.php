<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    protected $fillable = [
        'name', 'is_alcohol'
    ];

    public function foods()
    {
        return $this->hasMany('App\Food');
    }
}
