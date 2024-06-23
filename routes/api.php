<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherQuestionController;
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

Route::get('questions', [PollController::class, 'index']);

Route::post('answers', [AnswerController::class, 'store']);

//Route::group(['middleware' => 'auth'], function () {
    /// Poll
    Route::post('questions', [PollController::class, 'store']);
//    Route::get('questions/{Id}', [PollController::class, 'show']);
    Route::delete('questions/{Id}', [PollController::class, 'delete']);
    Route::get('questionWithAnswer', [PollController::class, 'questionWithAnswer']);

    /// Teacher Question
    Route::post('teacherQuestions', [TeacherQuestionController::class, 'store']);
    //    Route::get('teacherQuestions/{Id}', [TeacherQuestionController::class, 'show']);
    Route::delete('teacherQuestions/{Id}', [TeacherQuestionController::class, 'delete']);
    Route::patch('teacherQuestions/{Id}', [TeacherQuestionController::class, 'update']);
    Route::get('teacherQuestions', [TeacherQuestionController::class, 'questionWithAnswer']);

    /// Teacher
    Route::post('teachers', [TeacherController::class, 'store']);
    //    Route::get('teacherQuestions/{Id}', [TeacherController::class, 'show']);
    Route::delete('teachers/{Id}', [TeacherController::class, 'delete']);
    Route::patch('teachers/{Id}', [TeacherController::class, 'update']);

    /// Option
    Route::post('options', [OptionController::class, 'store']);
    Route::delete('options/{Id}', [OptionController::class, 'delete']);

//});

