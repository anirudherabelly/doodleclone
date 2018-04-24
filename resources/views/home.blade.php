@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="createnewevent">
                      <a href="/events/create"><button type="button" class="btn btn-primary btn-lg">Create new event</button></a>
                      <a href="/events/create"><button type="button" class="btn btn-primary btn-lg">Create new Poll</button></a>
                    </div>
                     <div class="eventcontainerlist">
                      <h2>Your Events</h2>
                      <table class="table">
                        <thead>
                          <th>#</th>
                          <th>Title</th>
                          <th>Description</th>
                        </thead>
                        <tbody>
                          @foreach($events as $event)
                            <tr>
                              <td>{{$event->id}}</td>
                              <td>{{$event->title}}</td>
                              <td>{{substr($event->description,0,50)}}{{strlen($event->description)>50?"...":""}}</td>
                              <td><a href="{{ route('events.show',$event->id)}}" class="btn btn-sm btn-default">Administer</a></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- You are logged in! -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
