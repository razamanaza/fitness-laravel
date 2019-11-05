@extends('layouts.app')

@section('charts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {
    packages: ["corechart", "gauge", "bar", "line"]
  });
  google.charts.setOnLoadCallback(activityChart);
  google.charts.setOnLoadCallback(weightIndexChart);
  google.charts.setOnLoadCallback(moodIndexChart);
  google.charts.setOnLoadCallback(activitiesByDays);
  google.charts.setOnLoadCallback(caloriesTrend);

  function activityChart() {
    var workouts = <?php echo $workouts; ?>;
    var data = google.visualization.arrayToDataTable(workouts);

    var options = {
      width: 400,
      height: 200
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
    console.log(weight_borders);
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

  function activitiesByDays() {
    var activities = <?php echo $activities; ?>;
    var data = google.visualization.arrayToDataTable(activities);

    var options = {
      height: 200,
    };

    var chart = new google.charts.Bar(
      document.getElementById("activitiesByDays")
    );
    chart.draw(data, google.charts.Bar.convertOptions(options));
  }

  function caloriesTrend() {
    var data = new google.visualization.DataTable();
    data.addColumn("number", "Days");
    data.addColumn("number", "Junk Food");
    data.addColumn("number", "Alcohol");
    data.addRows([
      [0, 500, 100],
      [1, 300, 0],
      [2, 600, 500],
      [3, 1200, 0],
      [4, 200, 0],
      [5, 0, 0],
      [6, 600, 500],
      [7, 800, 400],
      [8, 500, 0],
      [9, 450, 0],
      [10, 800, 0],
      [11, 750, 0],
      [12, 1000, 400],
      [13, 200, 100],
      [14, 500, 100],
      [15, 200, 200],
      [16, 650, 0],
      [17, 500, 0],
      [18, 1000, 200],
      [19, 800, 100],
      [20, 500, 200],
      [21, 650, 150],
      [22, 350, 50],
      [23, 240, 320],
      [24, 540, 0],
      [25, 220, 0],
      [26, 550, 220],
      [27, 320, 180],
      [28, 400, 0],
      [29, 200, 0]
    ]);

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
      height: 300
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

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          <div class="charts">
            <div class="row">
              <div class="col-md-3 text-center">
                <div id="weightIndex" class="chart"></div>
                <h2>Weight Index</h2>
              </div>
              <div class="col-md-6 text-center">
                <div id="activities" class="chart"></div>
                <h2>Activities Proportion</h2>
              </div>
              <div class="col-md-3 text-center">
                <div id="moodIndex" class="chart"></div>
                <h2>Mood Index</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 text-center">
                <div id="activitiesByDays" class="chart"></div>
                <h2>Activities Comparison</h2>
              </div>
              <div class="col-md-6 text-center">
                <div id="caloriesTrend" class="chart"></div>
                <h2>Excessive Calories Consumption</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
