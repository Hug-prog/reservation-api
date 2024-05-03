<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(Type::all(),"types");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            "name" => "required|string",
        ]);

        $type = new Type();
        $type->name = $request->name;

        $type->save();

        return $this->sendResponse($type,"type was created",201);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $type = Type::findOrFail($id);

        if (is_null($type)) {
            return $this->sendError("type not found.");
        }

        return $this->sendResponse($type, "Successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $type = $this->validationObject(Type::class,$id);
        return $this->sendResponse($type->delete(),"type was deleted");
    }
}
