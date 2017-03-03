<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Feedback;
use App\Event;
use App\Http\Requests;

class ModController extends Controller
{

    public function __construct()
    {
        $this->middleware('mod');
    }

    public function mod()
    {
      $events = Event::where('status', '=', 'CRE')->get();
      $feedbacks = Feedback::where('shown', '=', 'false')->with('author')->get();
      return view('mod/mod', compact('events', 'feedbacks'));
    }

    public function deleteEvent()
    {
        $eventID = Input::get('eventID');
        Event::find($eventID)->delete();
    }

    public function approveEvent()
    {
        $eventID = Input::get('eventID');
        $event = Event::find($eventID);
        $event->status = 'APP';
        $event->save();
    }

    public function deleteFeedback()
    {
        $feedbackID = Input::get('feedbackID');
        Feedback::find($feedbackID)->delete();
    }
    
}
