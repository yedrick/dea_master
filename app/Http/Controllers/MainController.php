<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class MainController extends Controller {
    //
    // MOSTRA LA VISTA DE REGISTRO DEL FORMULARIO
    public function showFormRegisterStudents() {
        // obterndremos los activos en cursos
        $courses = Course::status()->get();
        return view('formulario',['courses'=>$courses]);
    }
    public function showFormRegisterProfesores() {
        // obterndremos los activos en cursos
        $subjects = Subject::get();

        $courses = Course::get();
        return view('formularioProfesor',['courses'=>$courses, 'subjects'=>$subjects]);
    }

   

   

    
}
