<?php

namespace App\Http\Controllers;
use App\Event;
use Illuminate\Http\Request;
use Auth;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
use App\EventSlot;
use App\Participant;
use App\EventParticipation;
use App\EventParticipationSlot;
use Illuminate\Support\Facades\DB;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doodleevents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
          'title'=>'required|max:255'
        ));
        //insert into db
        $user = Auth::user();
        $event=new Event;
        $event->title = $request->title;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->emailid = $user->email;

        // if(empty($request->session()->get('event'))){
        //     $event=new Event;
        //     $event->title = $request->title;
        //     $event->location = $request->location;
        //     $event->description = $request->description;
        //     $event->emailid = $user->email;
        //     $request->session()->put('event', $event);
        // }else{
        //     $event = $request->session()->get('event');
        //     $event->title = $request->title;
        //     $event->location = $request->location;
        //     $event->description = $request->description;
        //     $event->emailid = $user->email;
        //     // $product->fill($validatedData);
        //     $request->session()->put('event', $event);
        // }
        $event->save();
        $dates=$request->date;
        $starttimes=$request->starttime;
        $endtimes=$request->endtime;

        $participant=Participant::where('emailid',$user->email)->get();
        if(!isset($participant))
        {
          $participant=new Participant;
          $participant->name=$user->name;
          $participant->emailid=$event->emailid;
          $participant->save();
        }

        $eventParticipation=EventParticipation::where('emailid',$user->email)->get();
        // if(!isset($eventParticipation))
        // {
            $eventParticipation= new EventParticipation;
            $eventParticipation->eventid=$event->id;
            $eventParticipation->emailid=$event->emailid;
            $eventParticipation->save();
        // }

        foreach($dates as $key=>$value){
          $eventSlot=new EventSlot;
          $eventParticipationSlot=new EventParticipationSlot;
          $eventSlot->slotid=$key+1;
          $eventSlot->eventid=$event->id;
          $eventSlot->date=$value;
          $eventSlot->starttime=$starttimes[$key];
          $eventSlot->endtime=$endtimes[$key];
          $eventSlot->save();
          $eventParticipationSlot->eventid=$event->id;
          $eventParticipationSlot->slotid=$eventSlot->slotid;
          $eventParticipationSlot->emailid=$event->emailid;
          $eventParticipationSlot->response=true;
          $eventParticipationSlot->save();
          // $eventSlot.save();
        }



        $emailerListString=$request->emaillist;
        if(isset($emailerListString))
        {
          $emailerList=explode(";",$emailerListString );
          foreach($emailerList as $emailTo)
          {
            Mail::to($emailTo)->send(new DemoEmail(route('events.show',$event->id)));
          }
        }
        //redirect
        return redirect()->route('events.show',$event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event=Event::find($id);
        $names=EventParticipation::select('emailid')->where('eventid',$id)->distinct()->get();

        $dates=EventSlot::select('date')->where('eventid',$id)->distinct()->orderBy('date')->get();

        foreach($dates as $key=>$date){
          $timeslots[$key]=EventSlot::select('starttime','endtime')->where('eventid',$id)->where('date',$date->date)->distinct()->orderBy('starttime')->get();
        }

        foreach($names as $key=>$name){
          $variable[$key]=DB::table('event_slots')
            ->join('event_participation_slots', function($join){
              $join->on('event_slots.eventid', '=', 'event_participation_slots.eventid');
              $join->on('event_slots.slotid', '=', 'event_participation_slots.slotid');
            })
            ->where('event_slots.eventid',$id)
            ->where('event_participation_slots.emailid',$name->emailid)
            ->select('event_slots.*', 'event_participation_slots.*')
            ->orderBy('event_participation_slots.emailid')
            ->orderBy('event_slots.date')
            ->orderBy('event_slots.slotid')
            ->get();

            // $a=$variable[$key];
            //
            // $counter=1;
            // $prev_date="";
            // $curr_date="";
            // $html="";
            // foreach($a as $joinRes){
            //   $curr_date=$joinRes->date;
            //   if(strcmp($curr_date,$prev_date)){
            //     $counter=1;
            //   }
            //
            //   $countSlots=EventSlot::where('eventid',$id)->where('date',$joinRes->date)->count();
            //   if($counter==1){
            //     $html.="<td><table border='0'><tr>";
            //
            //   }
            //   if($joinRes->response==1)
            //   {
            //     $html.="<td><button class='btn btn-sm btn-success'><span class='glyphicon glyphicon-ok'></span></button></td>";
            //   }else {
            //     $html.="<td><button class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-ok'></span></button></td>";
            //   }
            //   if($counter==$countSlots){
            //     $html.="</tr></table></td>";
            //   }
            //   $counter++;
            //   $prev_date=$curr_date;
            // }
            // $helloworld[$key]=$html;
        }

        return view('doodleevents.show')->with('event',$event)->with('names',$names)->with('dates',$dates)->with('timeslots',$timeslots)->with('variable',$variable)->with('id',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
