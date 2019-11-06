@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Food / Workout types</div>

        <div class="card-body types">
          <ul class="nav nav-tabs" id="Types">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#workouts">Workout types</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#foods">Food types</a>
            </li>
          </ul>
          <div class="tab-content" id="TypesContent">
            <div class="tab-pane fade show active" id="workouts">
              @include('workout-types.index')
            </div>
            <div class="tab-pane fade" id="foods">
              @include('food-types.index')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
