@extends('layouts.app')

@section('content')
<div class="container">
  <h2>New Food Type</h2>
  <form action="{{ url('food-types') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Food name</label>
      <input type="text" id="name" class="form-control {{ $errors->has('target') ? 'isname' : '' }}" name="name" value="{{ old('name') }}" required>
    </div>
    <div class="form-check">
      <input type="checkbox" id="is_alcohol" class="form-check-input" name="is_alcohol" value="true">
      <label for="is_alcohol" class="form-check-label">Is it alcohol?</label>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
  @include('errors')
</div>
@endsection
