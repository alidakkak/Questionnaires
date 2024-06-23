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
            $teacherData = $request->all();
            $answersData = [];

            foreach ($request->answers as $answer) {
                $answersData[] = [
                    'value' => $answer['value'],
                    'teacher_question_id' => $answer['teacher_question_id'] ?? null,
                ];
            }

            $teacherData = array_merge($teacherData, ['answers' => json_encode($answersData)]);

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
