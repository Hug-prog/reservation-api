<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Models\Event;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(Place::all(),"places");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            "country" => "required|string",
            "city" => "required|string",
            "street_number" => "required|integer",
            "street" => "required|string",
        ]);

        $place = new Place();
        $place->country = $request->country;
        $place->city = $request->city;
        $place->street = $request->street;
        $place->street_number = $request->street_number;
        $place->save();

        return $this->sendResponse($place,"type was created",201);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $placeId,int $eventId)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $place = Place::findOrFail($id);

        if (is_null($place)) {
            return $this->sendError("place not found.");
        }

        return $this->sendResponse($place, "Successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $place = $this->validationObject(Place::class,$id);
        return $this->sendResponse($place->delete(),"place was deleted");
    }
}
