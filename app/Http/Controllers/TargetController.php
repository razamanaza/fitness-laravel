<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Target;

class TargetController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function create()
  {
    return view('targets.create');
  }

  public function store(Request $request)
  {
    $user_id = auth()->user()->id;
    $data = request()->validate([
      'target' => 'required|min:10:max:255',
    ]);
    $data['user_id'] = $user_id;

    Target::create($data);

    return redirect('/home');
  }

  public function destroy(Target $target)
  {
    $target->delete();
    return redirect('/home');
  }
}
