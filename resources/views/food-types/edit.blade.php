@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Edit food type</div>
    <div class="card-body">

      <form action="{{ url('food-types/' . $food_type->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="name">Food name</label>
          <input type="text" id="name" class="form-control {{ $errors->has('target') ? 'isname' : '' }}" name="name" value="{{ $food_type->name }}" required>
        </div>
        <div class="form-check">
          <input type="checkbox" id="is_alcohol" class="form-check-input" name="is_alcohol" {{ $food_type->is_alcohol ? "checked" : ""}}>
          <label for="is_alcohol" class="form-check-label">Is it alcohol?</label>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
      @include('errors')

    </div>
  </div>
</div>
@endsection
