<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quarter;
use App\Models\Subject;
use Illuminate\Http\Request;

class MainController extends Controller {
    //mostrara la visats de importr y exportar excel
    public function showImportExportExcel() {
        $courses = Course::get();
        $subjects = Subject::get();
        $quaters = Quarter::get();
        return view('importsExcel',['courses'=>$courses,'subjects'=>$subjects,'quaters'=>$quaters]);
    }
    // MOSTRA LA VISTA DE REGISTRO DEL FORMULARIO
    public function showFormRegisterStudents() {
        // obterndremos los activos en cursos
        $courses = Course::status()->get();
        return view('formulario',['courses'=>$courses]);
    }
}
