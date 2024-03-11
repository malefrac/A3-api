<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
{
    private $rules = [
        'document' => 'required|numeric|max:99999999999999999999|min:3',
        'fullname' => 'required|string|max:100',
        'sena_email' => 'required|email|max:100',
        'personal_email' => 'required|email|max:100',
        'phone' => 'numeric|max:999999999999999999999999999999',
        'password' => 'required|string|min:8|max:100',
        'type' => 'required|string|max:20',
        'profile'=> 'required|string|max:120'
    ];

    private $traductionAttributes = array(
        'document' => 'documento',
        'fullname' => 'nombre',
        'sena_email' => 'correo sena',
        'personal_email' => 'correo personal',
        'phone' => 'telefono',
        'password' => 'contraseña',
        'type' => 'tipo',
        'profile' => 'perfil' 
    );

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
            ], Response::HTTP_BAD_REQUEST);
        }

        return $data;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor::all();
        return response()->json($instructors, Response::HTTP_OK);
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

        $instructor = Instructor::create($request->all());
        $response = [
            'message' => 'Registro creado exitosamente',
            'instructor' => $instructor
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        return response()->json($instructor, Response::HTTP_OK);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {
        $data = $this->applyValidator($request);
        if(!empty($data))
        {
            return $data;
        }

        $instructor->update($request->all());
        $response = [
            'message' => 'Registro actualizado exitosamente',
            'instructor' => $instructor
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->delete();
        $response = [
            'message' => 'Registro eliminado exitosamente',
            'instructor' => $instructor->id
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
