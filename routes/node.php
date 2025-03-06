<?php

use App\Http\Controllers\MasterController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('model-list/{nodeName}',[MasterController::class,'modelList'])->name('model.list');
    Route::get('model/{nodeName}',[MasterController::class,'modelCreate'])->name('model');
    Route::get('model/{nodeName}/{id}', [MasterController::class,'modelEdit'])->name('model.edit');


    // post para cerar un dato
    Route::post('model/store/{nodeName}', [MasterController::class,'store'])->name('model.store');
    Route::post('model-order/{nodeName}', [MasterController::class,'updateOrderNode'])->name('model.order');
    Route::post('model-filter/{nodeName}', [MasterController::class,'createFilters'])->name('model.filter');
    Route::put('model/update/{nodeName}/{id}',[MasterController::class,'update'])->name('model.update');
    Route::get('model/delete/{nodeName}/{id}', [MasterController::class,'delete'])->name('model.delete');
    //exportar por node
    Route::get('model-export/{nodeName}', [MasterController::class,'exportNode'])->name('model.export');

    // ajax
    Route::post('model-ajax/relation/{nodeName}', [MasterController::class,'ajaxRelationNode'])->name('model.ajax.relation');


});
