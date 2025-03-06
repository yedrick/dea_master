<?php

namespace App\Services;

use App\Models\Person;
use App\Services\CrudNodeService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class NodeService extends CrudNodeService {

    protected $modelNode;

    public function __construct($model) {
        $this->modelNode = new $model;
        parent::__construct(new $model);
    }

    public function get($request) {
        if (count($request->all()) == 0) return $this->model::get();
        return $this->getParamsFilters($request);
    }

    // funcion para obtener un los parametros del request y guardarlos en un array
    public function getParamsFilters($request) {
        $this->model::query();
        foreach ($request->all() as $key => $value) {
            if($this->isRelation($key)) {
                $column= $this->getKeyRelation($key);
                if(!array_key_exists('table',$column) && !array_key_exists('column',$column))  continue;
                if($this->validateRelation($column['table'],$column['column'])) {
                    if($this->validateModelRelation($column['table'])) {
                        $this->model = $this->model->whereHas($column['table'], function($query) use ($column, $value) {
                            $query->where($column['column'], 'like', '%' . $value . '%');
                        });
                    }else {
                        Log::info('no existe el metodo la relacion  en el modelo '.$column['table']);
                        continue;
                    }
                }else {
                    Log::info('no existe la relacion en columna en la tabla'.$column['column']);
                    continue;
                }
            }
            if($this->validate($key)) $this->model = $this->model->where($key, 'like', '%' . $value . '%');
        }

        return $this->model->get();
    }

    // verificamoas que el modelo tenga la relacion
    public function validateModelRelation($table) {
        if(!method_exists($this->modelNode,$table)) return false;
        return true;
    }

    public function validate($key) {
        return Schema::hasColumn($this->modelNode->getTable(), $key);
    }

    public function validateRelation($table,$column) {
        return Schema::hasColumn($table, $column);
    }


    // verificar si inicia con 'f_' para saber si es una relacion
    public function isRelation($key) {
        if(is_string($key) && substr($key, 0, 2) == 'f_') return true;
        return  false;
    }

    // separar  el key por q lleba el nombre de la relacion y el nombre del campo
    public function getKeyRelation($key) {
        $relation = [];
        $key = explode('_', substr($key, 2));
        if (count($key) != 2) return $relation;
        $relation['table'] = $key[0];
        $relation['column'] = $key[1];
        return $relation;
    }


    // obtner  si es busqueda por relacion o no
    public function getRelation($key) {
        $relation = $this->modelNode->getRelation($key);

        return $relation;
    }

    // funcion para obtener los datos para el excel de un nodo
    public function getExcel($datos) {
        \Log::info('datos: '.$datos);
        $datos = json_decode($datos, true);
        return $this->model::select($datos)->get();
    }

}
