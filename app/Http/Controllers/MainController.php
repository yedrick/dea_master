<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class MainController extends Controller {
    //
    // MOSTRA LA VISTA DE REGISTRO DEL FORMULARIO
    public function showFormRegisterStudents() {
        // obterndremos los activos en cursos
        $courses = Course::status()->get();
        return view('formulario',['courses'=>$courses]);
    }
}
