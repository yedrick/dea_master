<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//añadir las rutas q hay en el archivo de node.php
require __DIR__.'/node.php';

