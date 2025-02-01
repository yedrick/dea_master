<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model{

    protected $table = 'professions';
    protected $with = [];
    public $timestamps=true;

    /* Create rules */
    public static $rules_created = array(
        'name' => 'required|string|max:255|unique:professions,name',
    );
        /* Updating rules */
    public static $rules_updated = array(
        'name' => 'required|string|max:255',
    );
    /* Delete rules falta */
    public static $rules_remove = array(
        "id"=>"required",
    );


    // Definir relaciones y atributos aquí

}
