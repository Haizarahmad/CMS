<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/classrooms', [ClassroomController::class, 'index'])->name('classrooms');
    Route::post('/classrooms/add', [ClassroomController::class, 'postClassroom'])->name('classrooms.post');
    Route::put('/classrooms/edit', [ClassroomController::class, 'updateClassroom'])->name('classrooms.update');
    Route::delete('/class/delete', [ClassroomController::class, 'deleteClassroom'])->name('classrooms.delete');
});

