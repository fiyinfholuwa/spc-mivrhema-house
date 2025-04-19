<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', [FrontendController::class, 'home'])->name('home');


Route::post('/register-conference', [FrontendController::class, 'store'])->name('register.conference');
//Route::get('/submissions', [FrontendController::class, 'showRegistrationsPage']);

//Route::get('/dashboard', function () {
//    return view('get_data');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [FrontendController::class, 'showRegistrationsPage'])->name('dashboard');
});

require __DIR__.'/auth.php';
