<?php

namespace App\Services;

use App\Models\Filter;

class FiltersService{

    protected $model;

    public function __construct() {
        $this->model = Filter::class;
    }

    public function getFilters() {
        return $this->model::get();
    }

    public function getFilter($node_id) {
        return $this->model::where('parent_id', $node_id)->get();
    }
}
