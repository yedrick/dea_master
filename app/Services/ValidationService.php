<?php

namespace App\Services;

class ValidationService {
    // validacion q si existe el nodo o no
    protected $node;
    protected $model;

    public function __construct($node) {
        $this->node = $node;
        $this->model = $node->model;
    }

    public function validate($request) {
        // $rules = [];
        // $columns = $this->model->columns;
        // foreach ($columns as $column) {
        //     $rules[$column->name] = $this->getRules($column);
        // }
        // return $request->validate($rules);
    }
}
