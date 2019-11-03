<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sleep extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
