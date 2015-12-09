<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('filter')) {
            return $this->search($request->get('filter'));
        }

    	$msg = Message::all();

        return response()->json($msg);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$msg = Message::create($request->all());

        return response()->json($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$msg = Message::find($id);

        return response()->json($msg);
    }

    /**
     * Get messages containing a certain phrase.
     *
     * @param  String $phrase
     * @return \Illuminate\Http\Response
     */
    public function search($phrase) 
    {
        $msgs = Message::where('message', 'LIKE', '%' . $phrase . '%')->get();

        return response()->json($msgs);
    }
}
