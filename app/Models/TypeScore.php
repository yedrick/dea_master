<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeScore extends Model{

    protected $table = 'type_scores';
    protected $with = [];
    public $timestamps=true;

    /* Create rules */
    public static $rules_created = array(
        'name' => 'required|string|unique:type_scores,name',
        'score' => 'required|string',
    );
        /* Updating rules */
    public static $rules_updated = array(
        'name' => 'required|string|max:255',
        'score' => 'required|string',
    );
    /* Delete rules falta */
    public static $rules_remove = array(
        "id"=>"required",
    );


    // Definir relaciones y atributos aquí
    
}
