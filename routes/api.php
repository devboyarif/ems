<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmailGroupController;

Route::controller(EmailController::class)->group(function () {
    Route::get('emails', 'index');
    Route::post('emails', 'sendEmail');
    Route::post('emails/attach-group', 'attachEmailGroup');
    Route::post('emails/detach-group', 'detachEmailGroup');
});

Route::get('email/groups', [EmailGroupController::class, 'index']);
