<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Place;
use App\Models\Type;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(Event::all(),"events");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "description" => "required|string",
            "nb_places" => "required|integer",
            "place_id" => "required|integer",
            "type_id" => "required|integer",
        ]);

        $place = $this->validationObject(Place::class, $request->place_id);
        $type = $this->validationObject(Type::class, $request->type_id);

        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->nb_places = $request->nb_places;
        $event->type()->associate($type);
        $event->save();

        $event->places()->attach($place);

        return $this->sendResponse($event,"type was created",201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $placeId,int $eventId)
    {
        //$place = $this->validationObject(Place::class, $placeId);

        //$event = $this->validationObject(Event::class, $eventId);

        //$event->places()->attach($place);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $event = Event::find($id);

        if (is_null($event)) {
            return $this->sendError("event not found.");
        }

        return $this->sendResponse($event,"Successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $event = $this->validationObject(Event::class,$id);
        return $this->sendResponse($event->delete(),"place was deleted");
    }
}
