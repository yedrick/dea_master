<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


require __DIR__.'/node.php';

require __DIR__.'/auth.php';

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
    Route::post('/save-teacher', [ProcessController::class, 'registerTeacher']);
    Route::get('/list-student', [MainController::class, 'showTableEstudentes'])->name('estudiantes.show');

    //rutas para el registro de los estudiantes
    Route::get('view-young-pst', [ProcessController::class, 'viewScoreYoung']);
    Route::post('save-score', [ProcessController::class, 'registerScoreYoung']);

});



Route::prefix('ajax')->group(function () {
    Route::get('/search-parent/{ci_number}', [ProcessController::class,'getParent']);
    Route::post('/save-registration', [ProcessController::class,'registerParentAndStudents']);
});

// subir imagen
Route::post('upload-image', [ProcessController::class, 'uploadImage']);

Route::get('pdf-credential', [ProcessController::class, 'generateCredencial']);
// Route::get('pdf-credential/{id}', [ProcessController::class, 'generateCredencial']);
Route::get('pdf-qr', [ProcessController::class, 'generateQr']);

Route::get('/imports', function () {
    return view('imports');
});

Route::get('register-young', [ProcessController::class, 'showFormRegisterYoung']);
Route::post('register-young', [ProcessController::class, 'registerYoung']);

Route::get('view-image/{id}', [ProcessController::class, 'viewImage']);

Route::get('view-pst/{code}', [ProcessController::class, 'viewPts']);

Route::get('view', function () {
    return view('inicialCode');
});



// Route::get('/loginImage', function () {
//     return view('loginImage');
// });
Route::get('/score', function () {
    return view('score');
});
// Route::get('/form', function () {
//     return view('form');
// });


