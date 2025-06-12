<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/spc-2025-feedback', [FrontendController::class, 'feedback'])->name('feedback');

Route::post('/submit-feedback', [FrontendController::class, 'submit'])->name('feedback.submit');

Route::post('/register-conference', [FrontendController::class, 'store'])->name('register.conference');

Route::post('/confirm-arrival/{id}', [FrontendController::class, 'confirmArrival'])->name('confirm.arrival');
//Route::get('/submissions', [FrontendController::class, 'showRegistrationsPage']);

//Route::get('/dashboard', function () {
//    return view('get_data');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [FrontendController::class, 'showRegistrationsPage'])->name('dashboard');
    Route::get('/get/feedback', [FrontendController::class, 'showRegistrationsPageFeedback'])->name('get.feedback');
});

require __DIR__.'/auth.php';
