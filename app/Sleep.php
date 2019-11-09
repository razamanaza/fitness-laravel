<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sleep extends Model
{
  protected $fillable = [
    'date', 'minutes', 'user_id'
  ];
  public function user()
    {
        return $this->belongsTo('App\User');
    }
}
