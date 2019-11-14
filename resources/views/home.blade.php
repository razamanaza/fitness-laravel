@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
<script>
$( document ).ready(function() {
  var waypoint = new Waypoint({
    element: document.getElementById('coach'),
    handler: function(direction) {
        $('#coach-img').removeClass('invisible');
        $('#coach-img').addClass('bounceInLeft');
        $('.alert').addClass('lightSpeedIn');
        $('.alert').removeClass('invisible');
    },
    offset: 200
  })
});
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {
    packages: ["corechart", "gauge", "bar", "line"]
  });
  google.charts.setOnLoadCallback(activityChart);
  google.charts.setOnLoadCallback(weightIndexChart);
  google.charts.setOnLoadCallback(moodIndexChart);
  google.charts.setOnLoadCallback(sleepIndexChart);
  google.charts.setOnLoadCallback(activitiesByDays);
  google.charts.setOnLoadCallback(caloriesTrend);

  function activityChart() {
    var workouts = <?php echo $workouts; ?>;
    var data = google.visualization.arrayToDataTable(workouts);

    var options = {
      height: 300,
      width: 330
    };

    var chart = new google.visualization.PieChart(
      document.getElementById("activities")
    );
    chart.draw(data, options);
  }

  function weightIndexChart() {
    var weight = <?php echo $weight; ?>;
    var weight_borders = <?php echo $weight_borders; ?>;
    var maxweigh = weight_borders.red > weight ? weight_borders.red : weight;
    var data = google.visualization.arrayToDataTable([
      ["Label", "Value"],
      ["Weight", weight]
    ]);

    var options = {
      width: 300,
      height: 200,
      greenFrom: weight_borders.green_low,
      greenTo: weight_borders.green,
      yellowFrom: weight_borders.green,
      yellowTo: weight_borders.yellow,
      redFrom: weight_borders.yellow,
      redTo: maxweigh,
      max: maxweigh
    };

    var chart = new google.visualization.Gauge(
      document.getElementById("weightIndex")
    );
    chart.draw(data, options);
  }

  function moodIndexChart() {
    var mood = <?php echo $mood; ?>;
    var data = google.visualization.arrayToDataTable([
      ["Label", "Value"],
      ["Mood", mood]
    ]);

    var options = {
      width: 300,
      height: 200,
      redFrom: 0,
      redTo: 2,
      yellowFrom: 2,
      yellowTo: 5,
      greenFrom: 5,
      greenTo: 10,
      max: 10
    };

    var chart = new google.visualization.Gauge(
      document.getElementById("moodIndex")
    );
    chart.draw(data, options);
  }

  function sleepIndexChart() {
    var sleep = <?php echo $sleep; ?>;
    var data = google.visualization.arrayToDataTable([
      ["Label", "Value"],
      ["Sleep", sleep]
    ]);

    var options = {
      width: 300,
      height: 200,
      redFrom: 0,
      redTo: 6,
      yellowFrom: 6,
      yellowTo: 8,
      greenFrom: 8,
      greenTo: 12,
      max: 20
    };

    var chart = new google.visualization.Gauge(
      document.getElementById("sleepIndex")
    );
    chart.draw(data, options);
  }

  function activitiesByDays() {
    var activities = <?php echo $activities; ?>;
    var data = google.visualization.arrayToDataTable(activities);

    var options = {
      height: 400,
      width: 1000
    };

    var chart = new google.charts.Bar(
      document.getElementById("activitiesByDays")
    );
    chart.draw(data, google.charts.Bar.convertOptions(options));
  }

  function caloriesTrend() {
    var calories = <?php echo $calories; ?>;
    var data = google.visualization.arrayToDataTable(calories);

    var options = {
      hAxis: {
        title: "Days"
      },
      vAxis: {
        title: "Calories"
      },
      colors: ["#AB0D06", "#007329"],
      trendlines: {
        1: {
          type: "linear",
          color: "#111",
          opacity: 0.3
        }
      },
      height: 300,
      width: 650
    };

    var chart = new google.visualization.LineChart(
      document.getElementById("caloriesTrend")
    );
    chart.draw(data, options);
  }
</script>
@endsection

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body dashboard">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          <div class="targets">
            @include('targets.index')
          </div>
          <div class="charts">
            <div class="row">
              <div class="col-md-4 text-center">
                <div id="weightIndex" class="chart"></div>
                <h2>Weight Index</h2>
              </div>
              <div class="col-md-4 text-center">
                <div id="sleepIndex" class="chart"></div>
                <h2>Sleep Index</h2>
              </div>
              <div class="col-md-4 text-center">
                <div id="moodIndex" class="chart"></div>
                <h2>Mood Index</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 text-center">
                <div id="activities" class="chart"></div>
                <h2>Activities Proportion</h2>
              </div>
              <div class="col-md-8 text-center">
                <div id="caloriesTrend" class="chart"></div>
                <h2>Excessive Calories Consumption</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <div id="activitiesByDays" class="chart"></div>
                <h2>Activities Comparison</h2>
              </div>
            </div>
          </div>
          <div class="coach" id="coach">
            @php $count = count($coach_motd) @endphp
            @if($count == 0)
            <p class="alert alert-warning animated">No sweet without sweat. How about a walk?</p>
            @else
            @foreach($coach_motd as $motd)
            <p class="alert {{$motd[1]}} animated">{{$motd[0]}}</p>
            @endforeach
            @endif
          </div>
          <div class="coach-img animated" id="coach-img"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
