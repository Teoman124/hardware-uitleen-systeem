<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HardwareItemController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Hardware (publiek)
Route::get('/hardware', [HardwareItemController::class, 'index'])->name('hardware.index');
Route::get('/hardware/{hardwareItem}', [HardwareItemController::class, 'show'])->name('hardware.show');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Uitleenverzoeken (ingelogd)
Route::middleware('auth')->group(function () {
    Route::get('/hardware/{hardwareItem}/loan', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/hardware/{hardwareItem}/loan', [LoanController::class, 'store'])->name('loans.store');
});
