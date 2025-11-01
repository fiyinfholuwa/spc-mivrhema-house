<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [FrontendController::class, 'store_api']);
Route::post('/send_email', [FrontendController::class, 'prepareEmails']);
Route::get('/cron_send_email', [FrontendController::class, 'sendPendingEmails']);
