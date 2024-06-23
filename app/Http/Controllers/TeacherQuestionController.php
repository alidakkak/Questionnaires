<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherQuestionRequest;
use App\Http\Requests\UpdateTeacherQuestionRequest;
use App\Http\Resources\TeacherQuestionResource;
use App\Models\TeacherQuestion;
use Illuminate\Http\Request;

class TeacherQuestionController extends Controller
{
    public function index()
    {
        $teacherQuestion = TeacherQuestion::all();

        return TeacherQuestionResource::collection($teacherQuestion);
    }

    public function questionWithAnswer()
    {
        $teacherQuestion = TeacherQuestion::all();

        return TeacherQuestionResource::collection($teacherQuestion);
    }

    public function store(StoreTeacherQuestionRequest $request)
    {
        try {
            $teacherQuestion = TeacherQuestion::create($request->all());

            return response()->json([
                'message' => 'Created SuccessFully',
                'data' => TeacherQuestionResource::make($teacherQuestion),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateTeacherQuestionRequest $request, $Id)
    {
        try {
            $teacherQuestion = TeacherQuestion::find($Id);
            if (! $teacherQuestion) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            $teacherQuestion->update($request->all());

            return response()->json([
                'message' => 'Updated SuccessFully',
                'data' => TeacherQuestionResource::make($teacherQuestion),
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
        $teacherQuestion = TeacherQuestion::find($Id);
        if (! $teacherQuestion) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return TeacherQuestionResource::make($teacherQuestion);
    }

    public function delete($Id)
    {
        try {
            $teacherQuestion = TeacherQuestion::find($Id);
            if (! $teacherQuestion) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            $teacherQuestion->delete();

            return response()->json([
                'message' => 'Deleted SuccessFully',
                'data' => TeacherQuestionResource::make($teacherQuestion),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
