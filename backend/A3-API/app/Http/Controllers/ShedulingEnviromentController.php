<?php

namespace App\Http\Controllers;

use App\Models\SchedulingEnviroment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ShedulingEnviromentController extends Controller
{
    
    private $rules = [
        'course_id' => 'numeric',
        'instructor_id' => 'numeric',
        'date_scheduling' => 'required|date|date_format:Y-m-d',
        'initial_hour' => 'required|string|max:9999999999|min:1',
        'final_hour' => 'required|string|max:9999999999|min:1',
        'environment_id' => 'numeric',
       
    ];

    private $traductionAttributes = array(
        'course_id' => 'curso',
        'instructor_id' => 'instructor',
        'date_scheduling' =>  'fecha de reserva',
        'initial_hour' => 'hora inicial',
        'final_hour' => 'hora final',
        'environment_id' => 'ambiente'
           
  );

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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sheduling_enviroments = SchedulingEnviroment::all();
        $sheduling_enviroments->load(['course', 'instructor', 'learning_enviroment']);
        return response()->json($sheduling_enviroments, Response::HTTP_OK);
  
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

        $sheduling_enviroment = SchedulingEnviroment::create($request->all());
        $response = [
            'message' => 'Registro creado exitosamente',
            'activity' => $sheduling_enviroment
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(SchedulingEnviroment $sheduling_enviroment)
    {
        $sheduling_enviroment->load(['course', 'instructor', 'learning_enviroment']);
        return response()->json($sheduling_enviroment, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchedulingEnviroment $sheduling_enviroment)
    {
        $data = $this->applyvalidator($request);
        if(!empty($data))
        {
            return $data;

        }

        $sheduling_enviroment->update($request->all());
        $response = [
            'message' => 'Registro actualizado exitosamente',
            'sheduling_enviroment' => $sheduling_enviroment
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchedulingEnviroment $sheduling_enviroment)
    {
        $sheduling_enviroment->delete();
        $response = [
            'message' => 'Registro eliminado exitosamente',
            'sheduling_enviroment' =>$sheduling_enviroment ->id
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
