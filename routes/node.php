<?php

use App\Http\Controllers\MasterController;
use Illuminate\Support\Facades\Route;

Route::get('model-list/{nodeName}',[MasterController::class,'modelList'])->name('model.list');
