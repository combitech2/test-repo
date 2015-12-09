<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Place;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('place_id')) {
            $place = Place::find($request->get('place_id'));
            $event = $place->events;
        } else {        
            $event = Event::all();
        }

        return response()->json($event);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::where('name', $request->get('name'))
                      ->where('place_facebook_id', $request->get('place_facebook_id'))
                      ->first();
                      
        if (!$event) {
    	   $event = Event::create($request->all());
        }

        return response()->json($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$event = Event::find($id);

        return response()->json($event);
    }
}
