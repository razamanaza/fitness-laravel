<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
  protected $fillable = ['target', 'user_id'];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
