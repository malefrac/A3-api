<?php

namespace App\Http\Controllers;

use App\Models\EnviromentType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EnviromentTypeController extends Controller
{

    private $rules = [
        'description' => 'required|string|max:50|min:3',
    ];

    private $traductionAttributes = array(
        'description' => 'descripción',
    );

    public function applyValidator(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        $data =[];
        if($validator->fails())
        {
            $data = response()->json([
                'errors'=> $validator->errors(),
                'data' => $request->all()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $data;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enviroment_types = EnviromentType::all();
      return response()->json($enviroment_types, Response::HTTP_OK);
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

        $enviroment_type = EnviromentType::create($request->all());
        $response=[
            'message'=> 'Registro creado exitosamente',
            'enviroment_type'=> $enviroment_type
        ];
        return response()->json($response, Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show(EnviromentType $enviroment_type)
    {
        return response()->json($enviroment_type, Response::HTTP_CREATED);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EnviromentType $enviroment_type)
    {
        $data = $this->applyValidator($request);
        if(!empty($data))
        {
            return $data;
        }

        $enviroment_type->update($request->all());
        $response=[
            'message'=> 'Registro actualizado exitosamente',
            'enviroment_type'=> $enviroment_type
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnviromentType $enviroment_type)
    {
        $enviroment_type->delete();
        $response=[
            'message'=> 'Registro Eliminado exitosamente',
            'enviroment_type'=> $enviroment_type->id
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
