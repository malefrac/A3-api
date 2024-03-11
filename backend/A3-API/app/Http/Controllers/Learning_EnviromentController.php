<?php

namespace App\Http\Controllers;

use App\Models\LearningEnviroment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class Learning_EnviromentController extends Controller
{
    private $rules =[
       
        'name' =>'required|string|max:50|min:3',
        'capacity' => 'numeric|max:9999999999',
        'area_mt2' => 'numeric|max:9999999999',
        'floor' => 'required|string|max:1',
        'inventory' => 'string|max:150',
        'type_id' => 'numeric',
        'location_id' => 'numeric',
        'status' => 'string|max:20|min:5'


    ];
    private $traductionAttributes = [

        'name' => 'nombre',
        'capacity' => 'capacidad',
        'area_mt2' => 'area_mt2',
        'floor' => 'piso',
        'inventory' => 'inventario',
        'type_id' => 'tipo',
        'location_id' => 'ubicación',
        'status' => 'estado'
    ];

    public function applyvalidator(Request $request){

        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        $data = [];
        if($validator->fails()){
            $data = response()->json([
                'errors' => $validator->errors(),
                'data' => $request->all()
            ], Response::HTTP_BAD_REQUEST);
        }
    
        return $data;
    }
    public function index()
    {
        {
            $learning_enviroments = LearningEnviroment::all();
            $learning_enviroments->load(['enviroment_type', 'location']);
            return response()->json( $learning_enviroments, Response::HTTP_OK);
      
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->applyvalidator($request);
        if(!empty($data))
        {
            return $data;

        }

        $learning_enviroment = LearningEnviroment::create($request->all());
        $response = [
            'message' => 'Registro creado exitosamente',
            'activity' =>$learning_enviroment
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(LearningEnviroment $learning_enviroment)
    {
        $learning_enviroment->load(['enviroment_type', 'location']);
        return response()->json($learning_enviroment, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LearningEnviroment $learning_enviroment)
    {
        $data = $this->applyvalidator($request);
        if(!empty($data))
        {
            return $data;

        }

        $learning_enviroment->update($request->all());
        $response = [
            'message' => 'Registro actualizado exitosamente',
            'learning_enviroment' => $learning_enviroment
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LearningEnviroment $learning_enviroment)
    {
        $learning_enviroment->delete();
        $response = [
            'message' => 'Registro eliminado exitosamente',
            'learning_enviroment' =>$learning_enviroment ->id
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
