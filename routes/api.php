<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherQuestionController;
use App\Http\Controllers\UserFormSubmissionController;
use App\Models\UserFormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);


Route::get('/polls', [PollController::class, 'index']);

Route::get('/newSubmission' , [UserFormSubmissionController::class , 'createNewSubmission']);



//Route::get('/polls/{id}' , [PollController::class , 'show']);
//Route::get('/questions' , [QuestionController::class , 'index']);
//Route::get('/questions/{id}' , [QuestionController::class , 'show']);


//Route::group(['middleware' => 'auth'], function () {

    /// Poll
    Route::post('/polls', [PollController::class, 'store']);
    Route::patch('/polls/{id}' , [PollController::class , 'update']);
    Route::delete('/polls/{Id}', [PollController::class, 'delete']);

    Route::post('/questions' , [QuestionController::class , 'store']);
    Route::patch('/questions/{id}' , [QuestionController::class , 'update']);
    Route::delete('/questions/{id}' , [QuestionController::class , 'delete']);

    Route::post('/answers' , [AnswerController::class , 'store']);
    Route::patch('/answers/{id}' , [AnswerController::class , 'update']);
    Route::delete('/answers/{id}' , [AnswerController::class , 'delete']);

    // Teachers
    Route::post('/teachers' , [TeacherController::class , 'store']);
    Route::patch('/teachers/{id}' , [TeacherController::class , 'update']);
    Route::delete('/teachers/{id}' , [TeacherController::class , 'delete']);

    // Teachers
    Route::post('/teacherQuestion' , [TeacherQuestionController::class , 'store']);
    Route::patch('/teacherQuestion/{id}' , [TeacherQuestionController::class , 'update']);
    Route::delete('/teacherQuestion/{id}' , [TeacherQuestionController::class , 'delete']);

    Route::get('/userSubmission' , [UserFormSubmissionController::class , 'index']);

//});

