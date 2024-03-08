<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    private $rules = [
        'name' => 'required|string|max:80|min:3',
        'address' => 'required|string|max:80|min:3',
        'status' => 'required|string|max:20|min:3',

    ];

    private $traductionAttributes = [
        'name' => 'nombre',
        'address' => 'dirección',
        'status' => 'estado',
    ];

    public function applyValidator(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        $data = [];
        if($validator->fails())
        {
            $data = response()->json([
                'errors' => $validator->errors(),
                'data' => $request->all()
            ],Response::HTTP_BAD_REQUEST);
        }

        return $data;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return response()->json($locations, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->applyValidator($request);
        if(!empty($data))
        {
            return $data;
        }

        $location = Location::create($request->all());
        $response = [
            'message' => 'Registro creado exitosamente',
            'location' => $location
        ];

        return response()->json($response, Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return response()->json($location, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $data = $this->applyValidator($request);
        if(!empty($data))
        {
            return $data;
        }

        $location->update($request->all());
        $response = [
            'message' => 'Registro actualizado exitosamente',
            'location' => $location
        ];

        return response()->json($response, Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        $response = [
            'message' => 'Registro eliminado exitosamente',
            'location' => $location->id
        ];

        return response()->json($response, Response::HTTP_OK);


    }
}
