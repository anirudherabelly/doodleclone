@extends('layouts.app')

@section('content')
<form action="/participant/create" method="POST">

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

            First name: <input type="text" name="fname"><br>
            <!-- <input type="hidden" name="country" value="Norway"> -->
            <input type="submit" value="Submit">
          </form>
</table>


@endsection
