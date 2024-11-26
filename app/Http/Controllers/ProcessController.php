<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            $course = $student['course'];
            $newStudent = Student::create($student);
            // asignamos el curso al estudiante
            // dd($course);
        }
        return response()->json(['status' => true, 'message' => 'Padre y estudiantes registrados correctamente']);
        Log::info('Estudiantes: '.json_encode($students));

    }
}
