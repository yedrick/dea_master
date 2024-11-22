<?php

namespace App\Services;

use App\Models\Field;
use App\Models\Node;

class FieldService {

    protected $node;
    protected $model;
    protected $fields;

    public function __construct($node) {
        $this->node = $node;
        $this->model = new $node->model;
        $this->fields = Field::query();
    }

    // funcion  para optener  los fields de un nodo segun display_list show
    public function getFieldShow() {
        return $this->fields->where('parent_id', $this->node->id)->where('display_list', 'show')->orderBy('order', 'asc')->get();
    }

    // funcion  para optener  los fields de un nodo
    public function getField() {
        return $this->fields->where('parent_id', $this->node->id)->orderBy('order', 'asc')->get();
    }

    // funcion para obtener todos los fields de un nodo
    public function getFieldAll() {
        return Field::query()->where('parent_id', $this->node->id)->get();
    }

    // funcion  para optener  los fields de un nodo segun display_list show
    public function getFieldShowModel() {
        $fields_model= $this->fields->where('parent_id', $this->node->id)->where('display_list', 'show')->orderBy('order', 'asc')->get();
        $hiddenAttributes=$this->model->getHidden();
        $fields = $fields_model->filter(function ($field) use ($hiddenAttributes) {
            return !in_array($field->name, $hiddenAttributes);
        });
        return $fields;
    }

    // obtener por id del field
    public function getById($id) {
        return Field::find($id);
    }

    //obtener la relacion y optener los campos de la relacion
    public function getFieldRelation($field) {
        $node=Node::where('name',$field->value)->first();
        if($node){
            $fieldService = new FieldService($node);
            return $fieldService->getField();
        }
    }

    // funciones para los campos del formulario
    public function getFieldForm() {
        return Field::query()->where('parent_id', $this->node->id)->where('display_item', 'show')->orderBy('order', 'asc')->get();
    }
}
