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

        $participant=new Participant;
        $participant->name=$user->name;
        $participant->emailid=$event->emailid;
        $participant->save();

        $eventParticipation= new EventParticipation;
        $eventParticipation->eventid=$event->id;
        $eventParticipation->emailid=$event->emailid;
        $eventParticipation->save();

        $eventSlot=new EventSlot;
        $eventParticipationSlot=new EventParticipationSlot;
        foreach($dates as $key=>$value){
          $eventSlot->eventid=$event->id;
          $eventSlot->date=$value;
          $eventSlot->starttime=$starttimes[$key];
          $eventSlot->endtime=$endtimes[$key];
          $eventSlot->save();
          $eventParticipationSlot->eventid=$event->id;
          $eventParticipationSlot->slotid=$eventSlot->id;
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
        return view('doodleevents.show')->with('event',$event);
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
