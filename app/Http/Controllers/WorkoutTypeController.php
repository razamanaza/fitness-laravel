<?php

namespace App\Http\Controllers;

use App\WorkoutType;
use Illuminate\Http\Request;

class WorkoutTypeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('workout-types.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = request()->validate([
      'name' => ['required', 'regex:/^(\d|\w|\s|-)+$/i', 'unique:workout_types,name'],
      'color' => ['required', 'regex:/^#(\d|\w){6}$/i'],
    ]);
    $data['has_distance'] = ($request->has_distance == "true" ? true : false);
    WorkoutType::create($data);
    return redirect('/types');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(WorkoutType $workout_type)
  {
    return view('workout-types.edit', compact('workout_type'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, WorkoutType $workout_type)
  {
    $data = request()->validate([
      'name' => ['required', 'regex:/^(\d|\w|\s|-)+$/i'],
      'color' => ['required', 'regex:/^#(\d|\w){6}$/i'],
    ]);
    $data['has_distance'] = ($request->has_distance  ? true : false);
    $workout_type->update($data);
    return redirect('/types');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(WorkoutType $workout_type)
  {
    $workout_type->delete();
    return redirect('/types');
  }
}
