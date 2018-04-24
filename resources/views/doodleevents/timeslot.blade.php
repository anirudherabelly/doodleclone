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
    cell2.innerHTML = "Start Time :<input type='time' name='time[]'>";
    cell3.innerHTML = "End Time :<input type='time' name='endtime[]'>";
  })
  // var btn = document.getElementById('submitbtn');
  // btn.addEventListener("click", function() {
  //   // console.log("button was clicked");
  //   // bYear=$("#birthyear").val();
  //   bYear=new Date();
  //   bEmail=$("#email").val();
  //   // console.log(bYear + bGender);
  //
  //   $.ajax({
  //     url:"/timeslot/create",
  //     type:"POST",
  //     data:{"selectedDate":bYear,"emailTo":bEmail},
  //     success:function(data,status){
  //
  //     },
  //     error:function(){
  //
  //     }
  //   });
  // })
});
</script>
<div class="container">
  <div class="row">
    <h1>Step 2</h1>
    <div class="col-md-8 col-md-offset-2">
      <div name="timeslotSelector">
        <!-- <div class="form-group">
          <label class="control-label" for="date">Date</label>
          <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
        </div> -->
        <!-- <form action="/timeslot/create" method="post">
          <p>Click the button to add a new row at the first position of the table and then add cells and content.</p>
          <table class="table" id="myTable">
            <tr>
              <td>Date :<input type="date" name="date[]"></td>
              <td>Start Time :<input type="time" name="time[]"></td>
              <td>End Time :<input type="time" name="endtime[]"></td>
            </tr>
          </table>
        <br>
        <button class="btn btn-default btn-success" id="addslots">Add Time Slots</button>
      <hr>
      <div name="emailListInput">
        <div class="form-group">
          <label class="control-label" for="date">Send to :</label>
          <textarea class="form-control" id="email" name="emaillist" placeholder="Enter emails separated by semicolon ';''" type=""></textarea>
        </div>
      </div>
      <div class="form-group">
        <button class="btn btn-primary " id="submitbtn" name="submit" type="submit">Submit</button>
      </div>
      </form> -->
      {!! Form::open(['route' => 'timeslot.store']) !!}
      <table class="table">
        <tr>
        <td>
          {!! Form::label('date', 'Date:') !!}
          {!! Form::Date('date') !!}
        </td>
        <td>
          {!! Form::label('starttime', 'Start Time:') !!}
          {!! Form::Time('date') !!}
        </td>
        <td>
          {!! Form::label('endtime', 'End Time:') !!}
          {!! Form::Time('date') !!}
        </td>
      </tr>
      </table>
      <button class="btn btn-default btn-success" id="addslots">Add Time Slots</button>
      {!! Form::label('emaillist', 'Send To:') !!}
      {!! Form::textarea('emaillist', '',['class'=>'form-control','placeholder'=>'Enter emails separated by semicolon']) !!}
      {!! Form::submit('Submit',['class'=>'btn btn-success btn-lg']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
