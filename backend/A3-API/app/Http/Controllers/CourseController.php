<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{

    private $rules = [
        'description' => 'required|string|max:100|min:3',
        'hours' => 'required|numeric|max:9999999999|min:1',
        'technician_id' => 'required|numeric|max:99999999999999999999',
        'type_id' => 'required|numeric|max:99999999999999999999'
    ];

    private $traductionAttributes = array(
        'description' => 'descripción',
        'hours' => 'horas',
        'technician_id' => 'técnico',
        'type_id' => 'tipo'
    );

    public function applyValidator(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        $data = [];
        if($validator-> fails())
        {
            $data  = response()->json([
                'errors ' => $validator->errors(),
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
        $courses = Course::all();//*EL MEETODO LOAD SOLO SE UTILIZA PARA COSNULTAR
        $courses->load(['careers']);//* se consulta cuando son varias//
        return response()->json($courses, Response::HTTP_OK);
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
        $course = Course::create($request->all());
        $reponse = [
            'message' => 'Registro creado exitosamente',
            'course' => $course
        ];

        return response()->json($reponse, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load(['career']);
        return response()->json($course, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $data = $this->applyValidator($request);
        if(!empty($data))
        {
            return $data;
        }
        $course-> update($request->all());
        $reponse = [
            'message' => 'Registro actualizado exitosamente',
            'activity' => $course
        ];

        return response()->json($reponse, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {

        $course->delete();
        $reponse = [
            'message' => 'Registro eliminado exitosamente',
            'activity' => $course->id
        ];

    return response()->json($reponse, Response::HTTP_OK);

    }
}
