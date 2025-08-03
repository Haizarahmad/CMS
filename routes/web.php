<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::get('/students/add', [StudentController::class, 'addStudentPage'])->name('students.add');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'destroy'])
    ->name('logout');
});


require __DIR__.'/auth.php';