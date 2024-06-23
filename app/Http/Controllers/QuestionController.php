<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestion;
use App\Http\Requests\UpdateQuestion;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $question = Question::orderBy('created_at' , 'desc')->get();
        return QuestionResource::collection($question);
    }

    public function store(StoreQuestion $request)
    {
        try {
            $poll = Question::create($request->only(['title']));
            return QuestionResource::make($poll);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateQuestion $request , $questionID){
        try {
            $question = Question::where('id' , $questionID)->first();
            if (!$question) {
                return response()->json([
                    'message' => 'question not found in the system',
                ], 404);
            }
            $question->update($request->only(['title']));
            return QuestionResource::make($question);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($Id)
    {
        $question = Question::find($Id);
        if (!$question) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return QuestionResource::make($question);
    }

    public function delete($questionID)
    {
        try {
            $question = Question::where('id' , $questionID)->first();
            if (!$question) {
                return response()->json([
                    'message' => 'poll not found in the system',
                ], 404);
            }
            $question->delete();
            return QuestionResource::make($question);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
