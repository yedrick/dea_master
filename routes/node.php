<?php

use App\Http\Controllers\MasterController;
use Illuminate\Support\Facades\Route;

Route::get('model-list/{nodeName}',[MasterController::class,'modelList'])->name('model.list');
Route::get('model/{nodeName}',[MasterController::class,'modelCreate'])->name('model');

// post para cerar un dato
Route::post('model/store/{nodeName}', [MasterController::class,'store'])->name('model.store');
