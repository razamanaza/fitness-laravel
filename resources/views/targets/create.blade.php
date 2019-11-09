@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Add Target</h2>
  <form action="{{ url('targets') }}" method="POST">
    @csrf
    <div class="form-group">
      <textarea name="target" id="target" class="form-control {{ $errors->has('target') ? 'is-invalid' : '' }}" rows="3"></textarea>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Set Target</button>
    </div>
  </form>
  @include('errors')
</div>
@endsection
