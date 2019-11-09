@extends('layouts.app')

@section('head')
<script src="//momentjs.com/downloads/moment.min.js" def></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js" def></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">
{!! $calendar->script() !!}
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Calendar</div>

        <div class="card-body types">
          <div id="spinner" class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
          </div>
          {!! $calendar->calendar() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
