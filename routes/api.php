<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmailGroupController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(EmailController::class)->group(function () {
    Route::get('emails', 'index');
    Route::post('emails', 'store');
    Route::post('attach/{email}/{email_group}', 'attachGroup');
    Route::post('detach/{email}', 'detachGroup');
    // Route::post('emails', 'store');
    // Route::get('emails/{email}', 'show');
    // Route::put('emails/{email}', 'update');
    // Route::delete('emails/{email}', 'destroy');
});

Route::get('email/groups', [EmailGroupController::class, 'index']);
