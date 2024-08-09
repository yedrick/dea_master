<?php

namespace App\Services;

class ColumnTypeMap {

    protected $types=[
        'varchar' => 'text',
        'text' => 'textarea',
        'date' => 'date',
        'time' => 'time',
        'datetime' => 'datetime-local',
        'int' => 'number',
        'bigint' => 'number',
        'float' => 'number',
        'double' => 'number',
        'decimal' => 'number',
        'file' => 'file',
        'image' => 'file'
    ];


    public function getColumnType($type, $name){
        if (strpos($name, 'image') !== false || strpos($name, 'file') !== false) {
            return 'file';
        }
        // verificamos si el tipo de dato es enum
        if (strpos($type, 'enum') !== false) {
            return 'select';
        }
        // verificamos si el tipo de dato es set
        if (strpos($type, 'set') !== false) {
            return 'select';
        }
        // verificamos si el tipo de dato es text
        if (strpos($type, 'text') !== false) {
            return 'textarea';
        }
        // verificamos si name tiene '_id'
        if (strpos($name, '_id') !== false) {
            return 'select';
        }
        // verificamos si el name es id  es number
        if ($name === 'id') {
            return 'number';
        }
        // verificamos  si es created_at , updated_at y deleted_at devolvemos date
        if ($name==='created_at'|| $name==='updated_at') {
            return 'date';
        }
        return $this->types[$type] ?? 'text';
    }
}
