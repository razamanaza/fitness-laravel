@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Lifetime stats</div>

        <div class="card-body success">
          <div class="row totals">
            <div class="col-md-2 offset-md-2 text-center"><img src="{{asset('img/consumed.png')}}" alt="consumed">
              <p class="number">{{$records['consumed']}}</p>
              <p class="explain">calories</p>
            </div>
            <div class="col-md-2 text-center"><img src="{{asset('img/burnt.png')}}" alt="burnt">
              <p class="number">{{$totals['calories']}}</p>
              <p class="explain">calories</p>
            </div>
            <div class="col-md-2 text-center"><img src="{{asset('img/workout.png')}}" alt="days in a row">
              <p class="number">{{$records['daysInRow']}}</p>
              <p class="explain">days in a row</p>
            </div>
            <div class="col-md-2 text-center"><img src="{{asset('img/hours.png')}}" alt="longest workout">
              <p class="number">{{$records['longestWorkout']}}</p>
              <p class="explain">longest workout</p>
            </div>
          </div>
          <div class="row stats">
            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th>Workout</th>
                    <th>#</th>
                    <th>Distance (km)</th>
                    <th>Duration (hr)</th>
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
                <tfoot class="stats-tfoot">
                  <tr>
                    <th>Total:</th>
                    <th>{{$totals['count']}}</th>
                    <th>{{$totals['distance']}}</th>
                    <th>{{$totals['duration']}}</th>
                    <th>{{$totals['calories']}}</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
