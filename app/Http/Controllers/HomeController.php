<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventCategory;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    function index(Request $request)
    {
        date_default_timezone_set('Europe/Belgrade');

        $events = Event::where('status', 'APP')->where('dateTimeFrom', '>', date("Y-m-d H:i:s"))->latest();

        $carouselEvents = $events->get()->take(3);
        $events = $events->simplePaginate(6);
        return view('index', compact('events', 'carouselEvents'));
    }

}