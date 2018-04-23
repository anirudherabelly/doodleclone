@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="createnewevent">
                      <a href="/createevent"><button type="button" class="btn btn-primary btn-lg">Create new event</button></a>
                    </div>
                    <div class="eventcontainerlist">
                      <ul>
                        <!-- <li>{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</li> -->
                        <li>{{ $email }}</li>
                      </ul>
                    </div>
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
