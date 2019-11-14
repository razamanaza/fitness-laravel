@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">New workout type</div>
    <div class="card-body">

      <form action="{{ url('workout-types') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="name">Workout name</label>
          <input type="text" id="name" class="form-control {{ $errors->has('target') ? 'isname' : '' }}" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
          <input type="color" id="color" class="form-control {{ $errors->has('color') ? 'isname' : '' }}" name="color" value="{{ old('color') }}" required>
          <label for="color">Color</label>
        </div>
        <div class="form-check">
          <input type="checkbox" id="has_distance" class="form-check-input" name="has_distance" value="true">
          <label for="has_distance" class="form-check-label">Has distance?</label>
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
