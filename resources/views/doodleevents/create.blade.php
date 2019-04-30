@if (Route::has('login'))
        @auth
        @extends('layouts.app')

        @section('content')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
        $(document).ready(function() {

          var tslotbtn=document.getElementById('addslots');
          tslotbtn.addEventListener("click",function(){
            // console.log("added time slot");
            var table = document.getElementById("myTable");
            var row = table.insertRow(0);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            cell1.innerHTML = "Date :<input type='date' name='date[]'>";
            cell2.innerHTML = "Start Time :<input type='time' name='starttime[]'>";
            cell3.innerHTML = "End Time :<input type='time' name='endtime[]'>";
            // cell1.innerHTML = "{!! Form::label('date[]', 'Date:') !!}{!! Form::Date('date[]') !!}";
            // cell2.innerHTML = "{!! Form::label('starttime[]', 'Start Time:') !!}{!! Form::Time('starttime[]') !!}";
            // cell3.innerHTML = "{!! Form::label('endtime[]', 'End Time:') !!}{!! Form::Time('endtime[]') !!}";
          })
        });
        </script>
        <div class="container">
          <div class="row">
            <h1>Welcome</h1>
            <h3>Create New Event</h3>
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
            {!! Form::textarea('description', '',['class'=>'form-control','placeholder'=>'Optional note']) !!}
            <!-- <table class="table" id="myTable">
              <tr>
              <td>
                {!! Form::label('date[]', 'Date:') !!}
                {!! Form::Date('date[]') !!}
              </td>
              <td>
                {!! Form::label('starttime[]', 'Start Time:') !!}
                {!! Form::Time('starttime[]') !!}
              </td>
              <td>
                {!! Form::label('endtime[]', 'End Time:') !!}
                {!! Form::Time('endtime[]') !!}
              </td>
            </tr>
            </table> -->
            <table class="table" id="myTable">
              <tr>
                <td>Date :<input type="date" name="date[]"></td>
                <td>Start Time :<input type="time" name="starttime[]"></td>
                <td>End Time :<input type="time" name="endtime[]"></td>
              </tr>
            </table>
            <button class="btn btn-default btn-success" type="button" id="addslots">Add Time Slots</button>
            <hr>
            {!! Form::label('emaillist', 'Send To:') !!}
            {!! Form::textarea('emaillist', '',['class'=>'form-control','placeholder'=>'Enter emails separated by semicolon']) !!}
            {!! Form::submit('Create Event',['class'=>'btn btn-success btn-lg']) !!}
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
