<?php

namespace App\Http\Controllers;

use App\Exports\CustomExportReport;
use App\Imports\StudentsImport;
use App\Models\Student;
use App\Models\User;
use App\Services\ReportExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProcessController extends Controller {
    // obtener el padre  en user
    public function getParent($ci_number) {
        if($ci_number!=null){
            Log::info('Obtener el padre de un usuario');
            $user= User::where('ci_number',$ci_number)->first();
            if(!$user) return response()->json(['status' => false, 'message' => 'Padre no encontrado','user' => null]);
            if(!$user->hasRole('padre')) return response()->json(['status' => false, 'message' => 'El usuario no es un padre','user' => null]);
            return response()->json(['status' =>true, 'message' => 'Padre encontrado','user' => $user]);
        }
        return response()->json(['status' => false, 'message' => 'El campo ci_number es requerido']);
    }

    // registro de padre y studensts
    public function registerParentAndStudents(Request $request) {
        Log::info('Registro de padre y estudiantes');
        Log::info($request->all());
        $data = $request->all();
        $padre = $data['parent'];
        $students = $data['children'];
        Log::info('Padre: '.json_encode($padre));
        // registro del padre en user
        if(isset($padre['id']) && $padre['id']!=null){
            $user=User::find($padre['id']);
        }else{
            $user = new User();
            $user->name = $padre['name'];
            $user->email = $padre['email'];
            $user->phone = $padre['phone'];
            $user->ci_number = $padre['ci_number'];
            $user->password = bcrypt($padre['ci_number']);
            $user->save();
        }
        // asignamos el role de padre
        $user->assignRole('padre');
        // registro de los estudiantes
        foreach ($students as $student) {
           // $course = $student['course'];
            $newStudent = Student::create($student);
            // asignamos el curso al estudiante
            // dd($course);
        }
        return response()->json(['status' => true, 'message' => 'Padre y estudiantes registrados correctamente']);
        Log::info('Estudiantes: '.json_encode($students));

    }

    // exportar data en excel
    public function exportData() {
        $titles = ['ID','Nombre','Apellido','Nota','Descripcion'];
        $students = Student::get();
        $data = [];
        foreach ($students as $student) {
            $data[] = [$student->id, $student->first_name, $student->last_name, '0', '-'];
        }
        // vlaidamos q existan estudiantes
        if(count($data)==0) return redirect('/import-export')->with('message_error', 'No hay estudiantes para exportar');
        $excel= new ReportExcel();
        $response=$excel->generateExcel($titles,$data,'estudiantes','estudiantes');
        return $response;
    }

    // importar data en excel
    public function importData(Request $request) {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
            'course_id'=>'required',
            'subject_id'=>'required',
            'quarter_id'=>'required',
        ]);
        // $file = $request->file('file');
        \Log::info('Importar data en excel');
        \Log::info($request->all());

        // uptenemos el user logueado
        $user = auth()->user();
        // verificamso si el usuario es un profesor
        if(!$user->hasRole('profesor')) return redirect('/import-export')->with('message_error', 'No tienes permisos para realizar esta acción');
        $teacher = $user->teacher;
        \Log::info('Profesor: '.json_encode($teacher));
        if(!$teacher) return redirect('/import-export')->with('message_error', 'No tienes  un profesor asiganado');
        Excel::import(new StudentsImport($request->course_id, $request->subject_id, $request->quarter_id,$teacher->id), $request->file('file'));

        return redirect('/import-export')->with('message_success', 'Datos importados correctamente');
    }


}
