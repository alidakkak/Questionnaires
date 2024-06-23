<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Teacher::all();

        return TeacherResource::collection($teacher);
    }

    public function store(StoreTeacherRequest $request)
    {
        DB::beginTransaction();
        try {
            $teacherData = $request->only(['student_name',
'course_name',
'course_date',
'center',
'teacher_name',
'rating']);

            $teacherData['dynamic_question_answers'] = json_encode($request->dynamic_question_answers);

            $teacher = Teacher::create($teacherData);

            DB::commit();

            return response()->json([
                'message' => 'Created Successfully',
                'data' => TeacherResource::make($teacher),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
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
