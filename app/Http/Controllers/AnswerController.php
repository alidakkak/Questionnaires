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
                   'value' => array_key_exists('value', $answer) ? $answer['value'] : null,
                   'poll_id' => array_key_exists('question_id', $answer) ? $answer['question_id'] : null,
                    'option_id' => array_key_exists('option_id', $answer) ? $answer['option_id'] : null,
                ]);
            }
            return response()->json([
                'message' => 'SuccessFully',
                'data' => AnswerResource::make($answer),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
