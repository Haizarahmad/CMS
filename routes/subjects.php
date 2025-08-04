<?php

use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects');
    Route::post('/subject/add', [SubjectController::class, 'postSubject'])->name('subjects.post');
    Route::put('/subject/edit', [SubjectController::class, 'updateSubject'])->name('subjects.update');
    Route::delete('/subject/delete', [SubjectController::class, 'deleteSubject'])->name('subjects.delete');
    
});

