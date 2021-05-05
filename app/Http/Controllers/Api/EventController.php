<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use \MongoDB\BSON\UTCDateTime as MongoDate;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Event::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //validaciones
        $validator = Validator::make($data, SaveEvent::rules());

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $data = $validator->validated();

        $data['allday'] = true; 
        $data['start'] = new MongoDate( strtotime($data['start'] ) * 1000 );
        $data['end'] = new MongoDate( strtotime($data['end'] ) * 1000 );

        return response()->json(Event::create($data),200);
    }

    public function store_by_hour(Request $request)
    {
        $data = $request->all();

        //validaciones
        $validator = Validator::make($data, SaveEvent::rules());

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $data = $validator->validated();

        $data['start'] = new MongoDate( strtotime($data['start'] ) * 1000 );
        $data['allday'] = false; 

        unset($data['end']);

        return response()->json(Event::create($data),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response()->json($event,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->all();

        //validaciones
        $validator = Validator::make($data, SaveEvent::rules());

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if(!isset($data['end'])){
            return response()->json("Fecha fin no esta establecida", 400);
        }

        $data = $validator->validated();

        $data['start'] = new MongoDate( strtotime($data['start'] ) * 1000 );
        $data['end'] = new MongoDate( strtotime($data['end'] ) * 1000 );
        $data['allday'] = true; 

        $event->update($data);

        return response()->json($event,200);
    }

    public function update_by_hour(Request $request, Event $event)
    {
        $data = $request->all();

        //validaciones
        $validator = Validator::make($data, SaveEvent::rules());

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $data = $validator->validated();

        $data['start'] = new MongoDate( strtotime($data['start'] ) * 1000 );
        $data['allday'] = false; 

        unset($data['end']);
        $event->unset('end');
        //unset($event->end);// no funciona

        $event->update($data);

        return response()->json($event,200);
    }

    public function update_range(Request $request, Event $event)
    {
        $data = $request->all();

        if(!isset($data['start']) || !isset($data['end'])){
            return response()->json("Debe de suministrar el rango", 400);
        }

        $data['start'] = new MongoDate( strtotime($data['start'] ) * 1000 );
        $data['end'] = new MongoDate( strtotime($data['end'] ) * 1000 );

        $event->update($data);

        return response()->json($event,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json("Ok",200);
    }
}
