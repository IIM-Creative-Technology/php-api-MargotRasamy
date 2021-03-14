<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        return \App\Models\Promotion::all();
    });
    Route::get('/promotions/{promotionId}', function ($promotionId) {
        return \App\Models\Promotion::findOrFail($promotionId);
    });
    // CREATE
    Route::post('/promotions', function (Request $request) {
        return (\App\Models\Promotion::create($request->all()));
    });
    // UPDATE
    Route::put('/promotions/{promotionId}', function ($promotionId, Request $request) {
        $promotion = \App\Models\Promotion::findOrFail($promotionId);
        $promotion->update($request->all());
        return $promotion;
    });
    // DELETE
    Route::delete('/promotions/{promotionId}', function ($promotionId) {
        \App\Models\Promotion::findOrFail($promotionId)->delete();
        return response()->json('Successfully deleted the promotion !');
    });
});
