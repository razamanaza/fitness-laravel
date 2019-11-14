@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Add target</div>
    <div class="card-body">


      <form action="{{ url('targets') }}" method="POST">
        @csrf
        <div class="form-group">
          <textarea name="target" id="target" class="form-control {{ $errors->has('target') ? 'is-invalid' : '' }}" rows="3"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Add Target</button>
        </div>
      </form>
      @include('errors')
    </div>
  </div>
</div>
@endsection
