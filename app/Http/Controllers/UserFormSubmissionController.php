<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewSubmissionRequest;
use App\Http\Resources\UserFormSubmissionResource;
use App\Models\UserFormSubmission;
use App\Models\UserSubmissionAnswer;
use Illuminate\Http\Request;

class UserFormSubmissionController extends Controller
{

    public function index(){
        try {
            $userSubmissions = UserFormSubmission::orderBy('created-at' , 'desc')->get();
            return  UserFormSubmissionResource::collection($userSubmissions);
        }catch (\Throwable $th){
            return response([
               'message' => 'error',
               'error' => $th->getMessage()
            ]);
        }
    }

    public function createNewSubmission(StoreNewSubmissionRequest $request){
        try {
            $submission = UserFormSubmission::create($request->only(['username','course_name', 'course_date', 'center', 'poll_id']));

            foreach ($request->question_answers as $question_answer){
                UserSubmissionAnswer::create([
                    'user_form_submission_id' =>  $submission->id,
                    'question_id' => $question_answer['question_id'],
                    'selected_answer_id' => $question_answer['selected_answer_id'],
                ]);
            }

        }catch (\Throwable $th){
            return response([
                'message' => 'error while process your request',
                'error' => $th->getMessage()
            ] , 500);
        }
    }
}
