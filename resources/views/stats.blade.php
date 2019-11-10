@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Lifetime stats</div>

        <div class="card-body success">
          <div class="row totals">
            <div class="col-md-2 text-center"><img src="{{asset('img/distance.png')}}" alt="kilometers">
              <p class="number">{{$totals['kilometers']}}</p>
              <p class="explain">kilometers</p>
            </div>
            <div class="col-md-2 text-center"><img src="{{asset('img/workout.png')}}" alt="workouts">
              <p class="number">{{$totals['count']}}</p>
              <p class="explain">workouts</p>
            </div>
            <div class="col-md-2 text-center"><img src="{{asset('img/hours.png')}}" alt="hours">
              <p class="number">{{$totals['hours']}}</p>
              <p class="explain">hours</p>
            </div>
            <div class="col-md-2 text-center"><img src="{{asset('img/consumed.png')}}" alt="consumed">
              <p class="number">{{$totals['consumed']}}</p>
              <p class="explain">calories</p>
            </div>
            <div class="col-md-2 text-center"><img src="{{asset('img/burnt.png')}}" alt="burnt">
              <p class="number">{{$totals['burnt']}}</p>
              <p class="explain">calories</p>
            </div>
            <div class="col-md-2 text-center"><img src="{{asset('img/drink.png')}}" alt="drinks">
              <p class="number">{{$totals['drinks']}}</p>
              <p class="explain">drinks</p>
            </div>
          </div>
          <div class="row stats">
            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th>Workout</th>
                    <th>#</th>
                    <th>Distance</th>
                    <th>Duration</th>
                    <th>Calories</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($stats as  $statname => $stat)
                    <tr>
                      <th>{{$statname}}</th>
                      <th>{{$stat['count']}}</th>
                      <th>{{$stat['distance']}}</th>
                      <th>{{$stat['duration']}}</th>
                      <th>{{$stat['burnt']}}</th>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
