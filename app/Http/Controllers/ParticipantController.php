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
class ParticipantController extends Controller
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
    public function createParticipant(Request $request)
    {
        // echo "Welcome";
        $eventid=$request->eventid;
        // echo $eventid;
        $checked=$request->check;
        $email=$request->name;
        $participant=Participant::where('emailid',$email)->first();
        if(isset($participant))
        {
          $eventSlots=EventSlot::where('eventid',$eventid)->get();
          // $eventParticipationSlots=EventParticipationSlot::where('eventid',$eventid)->where('emailid',$email)->first();
          // foreach($eventParticipationSlots as $ama)
          // {
          //   $ama->delete();
          // }

          foreach($eventSlots as $eventSlot){
            // $eventParticipationSlot=new EventParticipationSlot;
            $eventParticipationSlot=EventParticipationSlot::where('eventid',$eventid)->where('emailid',$email)->where('slotid',$eventSlot->slotid)->first();
            // $eventParticipationSlot=new EventParticipationSlot;
            // $eventParticipationSlot->eventid=$eventid;
            // $eventParticipationSlot->slotid=$eventSlot->slotid;
            // $eventParticipationSlot->emailid=$email;
            if(in_array($eventSlot->slotid,$checked))
            {
                $eventParticipationSlot->response=true;
            }else{
              $eventParticipationSlot->response=false;
            }
            $eventParticipationSlot->save();
          }
        }else {
          $eventSlots=EventSlot::where('eventid',$eventid)->get();

          $participant=new Participant;
          $participant->emailid=$email;
          $participant->name="Hello";
          $participant->save();

          $eventParticipation=new EventParticipation;
          $eventParticipation->eventid=$eventid;
          $eventParticipation->emailid=$email;
          $eventParticipation->save();
          echo count($eventSlots);
          foreach($eventSlots as $eventSlot){
            $eventParticipationSlot=new EventParticipationSlot;
            $eventParticipationSlot->eventid=$eventid;
            $eventParticipationSlot->slotid=$eventSlot->slotid;
            $eventParticipationSlot->emailid=$email;
            if(count($checked)>0)
            {
                if(in_array($eventSlot->slotid,$checked))
                {
                    $eventParticipationSlot->response=true;
                }else{
                  $eventParticipationSlot->response=false;
                }
            }else {
              $eventParticipationSlot->response=false;
            }

            $eventParticipationSlot->save();
          }
        }
        return redirect()->route('events.show',$eventid);
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
