<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Models\Promotion;
use \App\Models\Teacher;
use \App\Http\Controllers\AuthController;
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

Route::group([
    'middleware' => 'api',
    'prefix'     => 'auth',
], function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('jwt.auth')->group(function () {
    // READ
    Route::get('/promotions', function () {
        return Promotion::all();
    });
    Route::get('/promotions/{promotionId}', function ($promotionId) {
        return Promotion::findOrFail($promotionId);
    });
    // CREATE
    Route::post('/promotions', function (Request $request) {
        return (Promotion::create($request->all()));
    });
    // UPDATE
    Route::put('/promotions/{promotionId}', function ($promotionId, Request $request) {
        $promotion = Promotion::findOrFail($promotionId);
        $promotion->update($request->all());
        return $promotion;
    });
    // DELETE
    Route::delete('/promotions/{promotionId}', function ($promotionId) {
        Promotion::findOrFail($promotionId)->delete();
        return response()->json('Successfully deleted the promotion !');
    });



    // READ
    Route::get('/teachers', function () {
        return Teacher::all();
    });
    Route::get('/teachers/{id}', function ($id) {
        return Teacher::findOrFail($id);
    });
    // CREATE
    Route::post('/teachers', function (Request $request) {
        return (Teacher::create($request->all()));
    });
    // UPDATE
    Route::put('/teachers/{id}', function ($id, Request $request) {
        $teachers = Teacher::findOrFail($id);
        $teachers->update($request->all());
        return $teachers;
    });
    // DELETE
    Route::delete('/teachers/{id}', function ($id) {
        Teacher::findOrFail($id)->delete();
        return response()->json('The teacher left his position at IIM !');
    });
});
