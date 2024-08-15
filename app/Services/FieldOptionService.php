<?php

namespace App\Services;

use App\Models\FieldOption;

class FieldOptionService {

    protected $node;
    protected $model;
    protected $fields;

    public function __construct($node) {
        $this->node = $node;
        $this->model = new $node->model;
        $this->fields = FieldOption::query();
    }

    // funcion  para optener  los fields de un nodo segun display_list show
    public function getFieldOption($fields) {
        return $this->fields->whereIn('parent_id', $fields->pluck('id')->toArray())->get();
    }

}
