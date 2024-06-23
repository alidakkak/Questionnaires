<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Teacher::all();

        return TeacherResource::collection($teacher);
    }

    public function store(StoreTeacherRequest $request)
    {
        try {
            $teacher = Teacher::create($request->all());
            foreach ($request->answers as $answer) {
                Teacher::create([
                    'value' => $request->value,
                    'teacher_question_id' => array_key_exists('teacher_question_id', $answer) ? $answer['teacher_question_id'] : null,
                ]);
            }
            return response()->json([
                'message' => 'Created SuccessFully',
                'data' => TeacherResource::make($teacher),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateTeacherRequest $request, $Id)
    {
        try {
            $teacher = Teacher::find($Id);
            if (! $teacher) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            $teacher->update($request->all());

            return response()->json([
                'message' => 'Updated SuccessFully',
                'data' => TeacherResource::make($teacher),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($Id)
    {
        $teacher = Teacher::find($Id);
        if (! $teacher) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return TeacherResource::make($teacher);
    }

    public function delete($Id)
    {
        try {
            $teacher = Teacher::find($Id);
            if (! $teacher) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            $teacher->delete();

            return response()->json([
                'message' => 'Deleted SuccessFully',
                'data' => TeacherResource::make($teacher),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
