@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Food / Workout types</div>

        <div class="card-body types">
          <ul class="nav nav-tabs" id="types" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="workout-types" data-toggle="tab" href="#home" role="tab">Workout types</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="food-types" data-toggle="tab" href="#profile" role="tab">Food types</a>
            </li>
          </ul>
          <div class="tab-content" id="types">
            <div class="tab-pane fade show active" id="workout-types" role="tabpanel">
              @include('workout-types.index')
            </div>
            <div class="tab-pane fade" id="food-types" role="tabpanel">
              @include('food-types.index')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
