@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <h1>{{ $event->title}}</h1>
    <!-- <h3>What's the occasion?</h3> -->
    <hr>
    <div class="col-md-8 col-md-offset-2">
      <p class="lead">{{$event->description}}</p>
    </div>
  </div>
</div>
@endsection
