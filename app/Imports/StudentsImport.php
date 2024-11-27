<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements  ToModel,WithHeadingRow{
    protected $courseId;
    protected $subjectId;
    protected $quarterId;
    protected $teacherId;

    public function __construct($courseId, $subjectId, $quarterId, $teacherId){
        $this->courseId = $courseId;
        $this->subjectId = $subjectId;
        $this->quarterId = $quarterId;
        $this->teacherId = $teacherId;
    }

    public function model($rows){
        \Log::info('---------------------------------');
        $data = [];
        foreach ($rows as $column=>$value) {
            if(in_array($column, ['id','nombre','apellido','nota','descripcion'])){
                if($column=='id'){
                    // validamos q existe el estudiante
                    $student = \App\Models\Student::find($value);
                    if(!$student){
                        \Log::info('Estudiante no encontrado');
                        return null;
                    }
                    $data['student_id'] = $value;
                    // $data['course_id'] = $this->courseId;
                    $data['subject_id'] = $this->subjectId;
                    $data['quarter_id'] = $this->quarterId;
                    $data['teacher_id'] = $this->teacherId;
                }
                if($column=='nota'){
                    $data['qualification'] = floatval($value);
                }
                if($column=='descripcion'){
                    if($value==='-'){
                        $value = '';
                    }
                    $data['description'] = $value;
                }
            }
        }
        \Log::info('Data: ');
        \Log::info(json_encode($data));
        return new \App\Models\Qualification($data);

    }
}
