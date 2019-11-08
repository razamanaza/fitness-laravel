@extends('layouts.app')

@section('head')
{!! $calendar->script() !!}
@endsection

@section('content')
{!! $calendar->calendar() !!}
@endsection
