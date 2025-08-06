<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OCRController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'destroy'])
    ->name('logout');
});


require __DIR__.'/auth.php';
require __DIR__.'/subjects.php';
require __DIR__.'/classrooms.php';
require __DIR__.'/students.php';