<?php

namespace App\Http\Controllers;

use App\Exports\CustomExportReport;
use App\Helpers\Func;
use App\Imports\StudentsImport;
use App\Models\Student;
use App\Models\TypeScore;
use App\Models\User;
use App\Models\Youth;
use App\Models\YouthScore;
use App\Services\ReportExcel;
use Doctrine\DBAL\Types\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

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

    // creascion del teacher
    public function registerTeacher(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'ci_number' => 'required|unique:users,ci_number',
            'subject_id' => 'required',
            'courses' => 'required|array',
        ]);
        \Log::info('Registro de profesor');
        \Log::info($request->all());
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->ci_number = $request->ci_number;
        $user->password = bcrypt($request->ci_number);
        $user->save();
        $user->assignRole('profesor');
        // creamos teacher
        $teacher = $user->teacher()->create(['subject_id' => $request->subject_id]);
        // asignamos los cursos al profesor
        $teacher->courses()->sync($request->courses);
        return redirect('/form-teacher')->with('message_success', 'Profesor registrado correctamente');
    }

    //genracion de pdf en credenciales
    public function generateCredencial() {
        $students = Student::get();
        $pdf = \PDF::loadView('pdf.credencial', ['students' => $students]);
        return $pdf->download('credenciales.pdf');
    }

    //genracion de pdf
    public function generateQr() {
        $students = Student::get();
        $pdf = \PDF::loadView('pdf.qr', ['students' => $students]);
        // return $pdf->download('qrs.pdf');
        return $pdf->stream();
    }

    public function showFormRegisterYoung() {
        $code = mt_rand(100, 200);
        // Generar el código y verificar si ya existe
        while (Youth::where('code', $code)->exists()) {
            $code = mt_rand(100, 200); // Si existe, genera uno nuevo
        }
        return view('form',['code'=>$code]);
    }

    public function viewImage($id) {
        $young = Youth::find($id);
        $link=Func::getImageUrl('youngs','text',$young->image);
        \Log::info($link);
        return view('viewImage',['link'=>$link]);
    }

    public function uploadImage(Request $request) {
        $request->validate([
            'image' => 'required|image',
        ]);
        $image_name=Func::upload($request->file('image'),'youngs',$request->code,['extension'=>'jpg']);
        return response()->json(['status' => true, 'message' => 'Imagen subida correctamente','path'=>$image_name]);
    }



    public function registerYoung(Request $request) {
        // vlaidacion de los datos

        // dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required',
            'phone_number' => 'required',
            'career' => 'nullable|string',
            'code'=>'required|unique:youths,code',
            'image' => 'required|image',
        ]);

        $image_name=Func::upload($request->file('image'),'youngs',$request->code,['extension'=>'jpg']);
        // creacion joven Young
        $young = new Youth();
        $young->first_name = $request->first_name;
        $young->last_name = $request->last_name;
        $young->birth_date = $request->birth_date;
        $young->phone_number = $request->phone_number;
        $young->career = $request->career;
        $young->discipleship=$request->discipleship;
        $young->baptized=$request->baptized;
        $young->code = $request->code;
        $young->password=bcrypt($request->phone_number);
        $young->image = $image_name;
        $young->save();
        // return redirect('register-young')->with('message_success', 'Joven registrado correctamente');
        return redirect('view-image/'.$young->id);
    }

    public function viewPts($code) {
        $young = Youth::where('code', $code)->first();
        if(!$young) return redirect('/score')->with('message_error', 'No se encontro el joven');
        $link=Func::getImageUrl('youngs','text',$young->image);
        $response = Http::head($link);
        if (!$response->successful()) {
            $link=asset('image/logo1.png');
        }
        // $pts=YouthScore::sum('pts');
        $positivos = YouthScore::where('pts', '>=', 0)->sum('pts');
        $negativos = YouthScore::where('pts', '<', 0)->sum('pts');
        $pts = $positivos + $negativos;
        
        return view('loginImage',['young'=>$young,'link'=>$link,'pts'=>$pts]);
    }

    public function viewScoreYoung() {
        $youngs = Youth::get();
        $type_scores=TypeScore::get();
        $youngId=request()->get('young_id');
        \Log::info('Joven: '.$youngId);
        if($youngId){
            //5
            $youngScores = YouthScore::where('youth_id', $youngId)->whereDate('created_at', Carbon::today())->whereNotIn('type_score_id', [5])->pluck('type_score_id')->toArray();
            $type_scores = TypeScore::whereNotIn('id', $youngScores)->get();
        }
        return view('score',['youngs'=>$youngs,'type_scores'=>$type_scores]);
    }

    public function registerScoreYoung(Request $request) {
        if(!$request->score) return redirect('/view-young-pst')->with('message_error', 'Debe seleccionar al menos un puntaje');
        if (!$request->young_id) return redirect('/view-young-pst')->with('message_error', 'Debe seleccionar un joven');
        $typeScores=TypeScore::whereIn('id',$request->score)->select('id','score')->get();
        $dataToInsert = [];
        foreach ($typeScores as $typeScore) {
            $dataToInsert[] = [
                'youth_id' => $request->young_id,
                'type_score_id' => $typeScore->id,
                'pts' => $typeScore->score,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        YouthScore::insert($dataToInsert);
        return redirect('/view-young-pst')->with('message_success', 'Puntos registrados correctamente');
    }
}
