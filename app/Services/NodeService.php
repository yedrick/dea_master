<?php

namespace App\Services;

use App\Helpers\MasterFunc;
use App\Models\Person;
use App\Services\CrudNodeService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class NodeService extends CrudNodeService
{

    protected $modelNode;

    public function __construct($model)
    {
        $this->modelNode = new $model;
        parent::__construct(new $model);
    }

    // public function get($request) {
    //     if (count($request->all()) == 0) return $this->model::get();
    //     return $this->getParamsFilters($request);
    // }

    public function get($request, $node = null)
    {
        // Empezamos la consulta
        $query = $this->model::query();

        // Aplicamos filtros del request si existen
        if (count($request->all()) > 0) {
            $query = $this->getParamsFilters($request, $query);
        }
        // Aplicar filtro según el nodo
        $data = MasterFunc::filterNode($node, $query);

        return $data->get(); // Asegurar que se ejecute la consulta
    }

    // funcion para obtener un los parametros del request y guardarlos en un array
    public function getParamsFilters($request, $query)
    {
        foreach ($request->all() as $key => $value) {
            if ($this->isRelation($key)) {
                $column = $this->getKeyRelation($key);
                if (!isset($column['table']) || !isset($column['column'])) continue;

                if ($this->validateRelation($column['table'], $column['column'])) {
                    if ($this->validateModelRelation($column['table'])) {
                        $query->whereHas($column['table'], function ($q) use ($column, $value) {
                            $q->where($column['column'], 'like', '%' . $value . '%');
                        });
                    } else {
                        Log::info('No existe el método de relación en el modelo: ' . $column['table']);
                    }
                } else {
                    Log::info('No existe la relación en la columna: ' . $column['column']);
                }
            } elseif ($this->validate($key)) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }

        return $query; // Devolver la consulta en lugar de ejecutarla aquí
    }

    // verificamoas que el modelo tenga la relacion
    public function validateModelRelation($table)
    {
        if (!method_exists($this->modelNode, $table)) return false;
        return true;
    }

    public function validate($key)
    {
        return Schema::hasColumn($this->modelNode->getTable(), $key);
    }

    public function validateRelation($table, $column)
    {
        return Schema::hasColumn($table, $column);
    }


    // verificar si inicia con 'f_' para saber si es una relacion
    public function isRelation($key)
    {
        if (is_string($key) && substr($key, 0, 2) == 'f_') return true;
        return  false;
    }

    // separar  el key por q lleba el nombre de la relacion y el nombre del campo
    public function getKeyRelation($key)
    {
        $relation = [];
        $key = explode('_', substr($key, 2));
        if (count($key) != 2) return $relation;
        $relation['table'] = $key[0];
        $relation['column'] = $key[1];
        return $relation;
    }


    // obtner  si es busqueda por relacion o no
    public function getRelation($key)
    {
        $relation = $this->modelNode->getRelation($key);

        return $relation;
    }

    // funcion para obtener los datos para el excel de un nodo
    public function getExcel($datos)
    {
        \Log::info('datos: ' . $datos);
        $datos = json_decode($datos, true);
        return $this->model::select($datos)->get();
        //return $this->model::get();
    }
}
