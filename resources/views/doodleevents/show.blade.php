@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <h1>{{ $event->title}}</h1>
    <!-- <h3>What's the occasion?</h3> -->
    <hr>
    <div class="col-md-10 col-md-offset-1">
      <p class="lead">{{$event->description}}</p>
      <!-- <form method='POST' action='/participant/create' id='participant-form'> -->
      {!! Form::open(['route' => 'participant.create']) !!}
      <table class="table">
        <tr>
          <th></th>
          @foreach($dates as $date)
            <th class='text-center'>
              {{date('d F Y', strtotime($date->date))}}
              <!-- {{$date->date}} -->
            </th>
          @endforeach
        </tr>
        <tr>
          <th>
            PARTICIPANTS
          </th>

        @foreach($timeslots as $key=>$values)

          <td>
            <table>
              <tr class='text-center'>
                @foreach($values as $ama)
                <td >
                {{date('h:i A', strtotime($ama->starttime))}}-{{date('h:i A', strtotime($ama->endtime))}}
                </td>

                @endforeach
            </tr>
            </table>
          </td>
        @endforeach
        </tr>

        @foreach($names as $key=>$values)
        <tr>
          <td>{{$values->emailid}}</td>
          <?php
          $counter=1;
          $prev_date="";
          $curr_date="";
          ?>
          @foreach($variable[$key] as $joinRes)
            <?php
            $curr_date=$joinRes->date;
            if(strcmp($curr_date,$prev_date)){
              $counter=1;
            }

            $countSlots=App\EventSlot::where('eventid',$id)->where('date',$joinRes->date)->count();
            if($counter==1){
              echo "<td><table border='0'><tr>";

            }
            if($joinRes->response==1)
            {
              echo "<td width='150' style='background-color: #90EE90;' align='center'><font color='green'>&#10004;</font></td>";
            }else {
              echo "<td width='150' style='background-color: #FFB6C1;' align='center'><font color='red'>&#10008;</font></td>";
            }
            if($counter==$countSlots){
              echo "</tr></table></td>";
            }
            $counter++;
            $prev_date=$curr_date;
             ?>
          @endforeach
        </tr>
        @endforeach
        <?php
            $queryresults=App\EventSlot::select('slotid','date')->where('eventid',$id)->orderBy('date')->orderBy('slotid')->get();
            // echo "<form method='POST' action='/participant/create' id='participant-form'>";
            // <td width='155'>
            // <input type='email' placeholder='Enter your email-id' required name='name'/>
            // </td>
            $counter=1;
            $prev_date="";
            $curr_date="";
            echo "<tr>";
            echo "<td width='155'>";
            echo "<input type='email' placeholder='Enter your email-id' required name='name'/>";
            echo "</td>";
            foreach($queryresults as $result){
                      $curr_date=$result->date;
                      if(strcmp($curr_date, $prev_date)){
                        $counter=1;
                      }
                      $dt=$result->date;
                      $countSlots=App\EventSlot::where('eventid',$id)->where('date',$dt)->count();
                      //echo $counter."%".$count."%".$dt;
                      if($counter==1){
                        echo "<td>";
                        echo "<table>";
                        echo "<tr>";
                      }
                      $slot=$result->slotid;
                      // echo "<td width='155' align='center' style='background-color: #D3D3D3;'>";
                      // echo "<input type='checkbox' name='check[]' id='slot' value='".$slot."'>"."</td>";
                      echo "<td width='155' align='center' style='background-color: #D3D3D3;'>"."<input type='checkbox' name='check[]' id='slot' value='$slot'>"."</td>";
                      if($counter==$countSlots){
                        echo "</tr>";
                        echo "</table>";
                        echo "</td>";
                      }
                      $counter++;
                      $prev_date=$curr_date;
            }
        echo "</tr>";
        echo "<input type='hidden' name='eventid' value='".$id."'>";
        echo "<tr><td><input class='btn btn-default btn-success' type='submit' value='Submit'></td></tr>";
        echo "</form>";
        ?>
      </table>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
