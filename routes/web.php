<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/import-export', [MainController::class, 'showImportExportExcel']);
    Route::get('/export-student', [ProcessController::class,'exportData']);
    Route::post('/import', [ProcessController::class,'importData']);

    Route::get('/form-student', [MainController::class, 'showFormRegisterStudents']);
    Route::get('/form-teacher', [MainController::class, 'showFormRegisterProfesores']);
});

Route::prefix('ajax')->group(function () {
    Route::get('/search-parent/{ci_number}', [ProcessController::class,'getParent']);
    Route::post('/save-registration', [ProcessController::class,'registerParentAndStudents']);
});



Route::get('/imports', function () {
    return view('imports');
});


// Route::get('/formulario', function () {
//     return view('formulario');
// });

require __DIR__.'/node.php';

require __DIR__.'/auth.php';
