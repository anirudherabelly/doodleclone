@if (Route::has('login'))
        @auth
        @extends('layouts.app')

        @section('content')
        <div class="container">
          <div class="row">
            <h1>Create New Event</h1>
            <h3>What's the occasion?</h3>
            <hr>
            <div class="col-md-8 col-md-offset-2">
            <!-- <form>
            <div class="form-group">
            </div>
            </form> -->
            {!! Form::open(['route' => 'events.store']) !!}
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null,['class'=>'form-control']) !!}
            {!! Form::label('location', 'Location:') !!}
            {!! Form::select('location', ['Skype' => 'Skype Meeting', 'TBD' => 'To be Decided', 'WebEx' => 'Cisco WebEx'], null, ['class' =>'form-control','placeholder' => 'Pick a Location for the Meeting...']); !!}
            {!! Form::label('description', 'Description:') !!}
            {!! Form::textarea('description', 'Optional note',['class'=>'form-control']) !!}
            {!! Form::submit('Create Post',['class'=>'btn btn-success btn-lg']) !!}
            {!! Form::close() !!}

            </div>
          </div>
        </div>
        @endsection
        @else
        @section('content')
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                <h2>Please login to create more events.<h2>
                </div>
              </div>
            </div>
        @endsection
        @endauth
@endif
