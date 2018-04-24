<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;


class TimeSlotController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        return view('doodleevents.timeslot');
    }

    public function createTimeSlot(Request $request)
    {
        $event = $request->session()->get('event');
        if(isset($event->id))
        {
          $event->save();
          $emailerListString=$request->emaillist;
          if(isset($emailerList))
          {
            $emailerList=explode(";",$emailerListString );
            foreach($emailerList as $emailTo)
            {
              Mail::to($emailTo)->send(new DemoEmail(route('events.show',$event->id)));
            }
          }
        }
        return redirect()->route('events.show',$event->id);
    }
}
