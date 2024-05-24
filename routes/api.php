<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/subjects/list', [\App\Http\Controllers\API\SubjectsController::class, 'index']);
    Route::post('/subjects/add', [\App\Http\Controllers\API\SubjectsController::class, 'store']);
    Route::get('/subjects/edit/{id}', [\App\Http\Controllers\API\SubjectsController::class, 'edit']);
    Route::post('/subjects/update/{id}', [\App\Http\Controllers\API\SubjectsController::class, 'update']);
    Route::delete('/subjects/delete/{id}', [\App\Http\Controllers\API\SubjectsController::class, 'destroy']);

    Route::get('/papers/list', [\App\Http\Controllers\API\PapersController::class, 'index']);
    Route::post('/papers/add', [\App\Http\Controllers\API\PapersController::class, 'store']);
    Route::get('/papers/edit/{id}', [\App\Http\Controllers\API\PapersController::class, 'show']);
    Route::post('/papers/update/{id}', [\App\Http\Controllers\API\PapersController::class, 'update']);
    Route::delete('/papers/delete/{id}', [\App\Http\Controllers\API\PapersController::class, 'destroy']);

    Route::get('/papers/questions/list/{id}', [\App\Http\Controllers\API\QuestionsController::class, 'index']);
    Route::post('/papers/questions/add', [\App\Http\Controllers\API\QuestionsController::class, 'store']);
    Route::get('/papers/questions/edit/{id}', [\App\Http\Controllers\API\QuestionsController::class, 'show']);
    Route::post('/papers/questions/update/{id}', [\App\Http\Controllers\API\QuestionsController::class, 'update']);
    Route::delete('/papers/questions/delete/{id}', [\App\Http\Controllers\API\QuestionsController::class, 'destroy']);


    Route::get('/users/list', [\App\Http\Controllers\API\UserController::class, 'index']);
    Route::post('/users/assign_exams/add', [\App\Http\Controllers\API\UserController::class, 'assign_exams']);
    Route::delete('/users/delete/{id}', [\App\Http\Controllers\API\UserController::class, 'destroy']);



    Route::get('/exams/list', [\App\Http\Controllers\API\ExamsController::class, 'index']);
    Route::get('/exams/{id}', [\App\Http\Controllers\API\ExamsController::class, 'show']);
    Route::post('/exams/status/{id}', [\App\Http\Controllers\API\ExamsController::class, 'change_status']);
    Route::post('/exams/update/', [\App\Http\Controllers\API\ExamsController::class, 'update']);
    Route::delete('/exams/delete/{id}', [\App\Http\Controllers\API\ExamsController::class, 'destroy']);
    Route::get('/users/exam/{id}', [\App\Http\Controllers\API\ExamsController::class, 'get_user_exams']);
    Route::get('/users/exam/{id}/questions', [\App\Http\Controllers\API\ExamsController::class, 'get_user_exams_questions']);
    Route::get('/users/exams/results/single/{id}', [\App\Http\Controllers\API\ExamsController::class, 'get_user_results']);
    Route::get('/users/exams/results/{id}', [\App\Http\Controllers\API\ExamsController::class, 'exams_results']);

    Route::post('/users/exam/submit', [\App\Http\Controllers\API\ExamsController::class, 'save_exams']);

    // Route::get('/products/list', [\App\Http\Controllers\ProductController::class, 'index']);
    // Route::post('/products/add', [\App\Http\Controllers\ProductController::class, 'store']);
    // Route::get('/products/edit/{id}', [\App\Http\Controllers\ProductController::class, 'edit']);
    // Route::post('/products/update/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
    // Route::delete('/products/delete/{id}', [\App\Http\Controllers\ProductController::class, 'destroy']);

});


