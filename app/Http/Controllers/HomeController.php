<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getEvents()
    {
      // $useremail=Auth::user()->name;
    }
    public function index()
    {
        $useremail = Auth::user()->email;
        $events = Event::all();
        return view('home')->with("events",$events);
    }
}
