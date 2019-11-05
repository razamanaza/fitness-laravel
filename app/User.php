<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'height'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function targets()
  {
    return $this->hasMany('App\Target');
  }

  public function workouts()
  {
    return $this->hasMany('App\Workout');
  }

  public function sleeps()
  {
    return $this->hasMany('App\Sleep');
  }

  public function moods()
  {
    return $this->hasMany('App\Mood');
  }

  public function weights()
  {
    return $this->hasMany('App\Weight');
  }

  public function foods()
  {
    return $this->hasMany('App\Food');
  }
}
