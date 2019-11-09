<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
  protected $fillable = [
    'date', 'weight', 'user_id'
  ];
  public function user()
    {
        return $this->belongsTo('App\User');
    }
}
