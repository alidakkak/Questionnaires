<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Models\answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(StoreAnswerRequest $request)
    {
        try {
            foreach ($request->answers as $answer) {
                answer::create([
                   'value' => $answer['value'],
                   'poll_id' => $answer['question_id'],
                ]);
            }
            return response()->json([
                'message' => 'SuccessFully',
               // 'data' => AnswerResource::make($answer),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
