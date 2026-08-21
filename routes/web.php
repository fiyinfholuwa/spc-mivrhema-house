<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomKeyController;
use App\Http\Controllers\RoomMemberController;
use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Mail;

Route::get('/test-mail', function () {
    try {
        Mail::raw('SMTP test successful! 🎉', function ($message) {
            $message->to('fiyinfholuwa@gmail.com')
                    ->subject('Mail Test from LST');
        });

        return '✅ Mail sent successfully!';
    } catch (\Exception $e) {
        return '❌ Mail sending failed: ' . $e->getMessage();
    }
});


Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/spc-2025-feedback', [FrontendController::class, 'feedback'])->name('feedback');

Route::post('/submit-feedback', [FrontendController::class, 'submit'])->name('feedback.submit');

Route::post('/register-conference', [FrontendController::class, 'store'])->name('register.conference');

//Route::get('/submissions', [FrontendController::class, 'showRegistrationsPage']);

//Route::get('/dashboard', function () {
//    return view('get_data');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [FrontendController::class, 'showRegistrationsPage'])->name('dashboard');
    Route::get('/analytics', [FrontendController::class, 'analytics'])->name('analytics');
    Route::post('/confirm-arrival/{id}', [FrontendController::class, 'confirmArrival'])->name('confirm.arrival');
    Route::get('/get/feedback', [FrontendController::class, 'showRegistrationsPageFeedback'])->name('get.feedback');
    Route::get('/room-keys', [RoomKeyController::class, 'index'])->name('room-keys.index');
    Route::post('/room-keys/{room}/checkout', [RoomKeyController::class, 'checkout'])->name('room-keys.checkout');
    Route::patch('/room-key-logs/{keyLog}/return', [RoomKeyController::class, 'returnKey'])->name('room-keys.return');
    Route::get('/room-keys/{room}/history', [RoomKeyController::class, 'history'])->name('room-keys.history');
    Route::get('/room-members/search', [RoomMemberController::class, 'search'])->name('room-members.search');
    Route::get('/rooms/{room}/members', [RoomMemberController::class, 'index'])->name('room-members.index');
    Route::post('/rooms/{room}/members', [RoomMemberController::class, 'store'])->name('room-members.store');
    Route::patch('/room-members/{member}/exit', [RoomMemberController::class, 'markExited'])->name('room-members.exit');
});

require __DIR__.'/auth.php';
