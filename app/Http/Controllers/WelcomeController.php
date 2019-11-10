<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class WelcomeController extends Controller
{
  public function welcome() {
    if( Auth::check() ){
      return redirect('/home');
    } else {
      return view('welcome');
    }
  }

}
