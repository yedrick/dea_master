<?php

namespace App\Services;

class ColumnTypeMap {

    protected $types=[
        'varchar' => 'string',
        'string' => 'string',
        'text' => 'textarea',
        'date' => 'date',
        'time' => 'time',
        'datetime' => 'datetime-local',
        'int' => 'integer',
        'bigint' => 'integer',
        'float' => 'decimal',
        'double' => 'decimal',
        'decimal' => 'decimal',
        'file' => 'file',
        'image' => 'file'
    ];


    public function getColumnType($type, $name){

        if($name=='image'){
            return 'image';
        }
        if (strpos($name, 'image') !== false || strpos($name, 'file') !== false) {
            return 'file';
        }
        // verificamos si el tipo de dato es enum
        if (strpos($type, 'enum') !== false) {
            return 'select';
        }
        // verificamos si name tiene '_id'
        if (strpos($name, '_id') !== false) {
            return 'select';
        }
        // verificamos si el name es id  es number
        if ($name === 'id') {
            return 'integer';
        }
        // verificamos  si es created_at , updated_at y deleted_at devolvemos date
        if ($name==='created_at'|| $name==='updated_at' || $name==='deleted_at') {
            return 'date';
        }
        if ($name==='password') {
            return 'password';
        }
        return $this->types[$type] ?? 'text';
    }
}
