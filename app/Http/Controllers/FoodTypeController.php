<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodType;

class FoodTypeController extends Controller
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
    return view('food-types.create');
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
      'name' => ['required', 'regex:/^(\d|\w|\s|-)+$/i', 'unique:food_types,name'],
    ]);
    $data['is_alcohol'] = ($request->is_alcohol == "true" ? true : false);
    FoodType::create($data);
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
  public function edit(FoodType $food_type)
  {
    return view('food-types.edit', compact('food_type'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, FoodType $food_type)
  {
    $data = request()->validate([
      'name' => ['required', 'regex:/^(\d|\w|\s|-)+$/i'],
    ]);
    $data['is_alcohol'] = ($request->is_alcohol ? true : false);
    $food_type->update($data);
    return redirect('/types');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(FoodType $food_type)
  {
    $food_type->delete();
    return redirect('/types');
  }
}
