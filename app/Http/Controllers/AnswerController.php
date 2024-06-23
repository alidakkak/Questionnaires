<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Models\answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
//    public function index($questionID)
//    {
//        $answers = Answer::orderBy('created_at' , 'desc')->where('question_id' , $questionID)->get();
//        return AnswerResource::collection($answers);
//    }

    public function store(StoreAnswerRequest $request)
    {
        try {
            $answer = Answer::create($request->only(['title' , 'question_id' , 'is_correct']));
            return AnswerResource::make($answer);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateAnswerRequest $request , $answerID){
        try {
            $answer = Answer::where('id' , $answerID)->first();
            if (!$answer) {
                return response()->json([
                    'message' => 'question not found in the system',
                ], 404);
            }
            $answer->update($request->only(['title' , 'is_correct']));
            return AnswerResource::make($answer);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

//    public function show($answerID)
//    {
//        $answer = Answer::where('id' , $answerID)->first();
//        if (!$answer) {
//            return response()->json(['message' => 'Not found'], 404);
//        }
//        return AnswerResource::make($answer);
//    }

    public function delete($answerID)
    {
        try {
            $answer = Answer::where('id' , $answerID)->first();
            if (!$answer) {
                return response()->json([
                    'message' => 'poll not found in the system',
                ], 404);
            }
            $answer->delete();
            return AnswerResource::make($answer);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
