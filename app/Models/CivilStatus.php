<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model{

    protected $table = 'civil_statuses';
    protected $with = [];
    public $timestamps=true;

    /* Create rules */
    public static $rules_created = array(
        'name' => 'required|string|unique:civil_statuses,name',
    );
        /* Updating rules */
    public static $rules_updated = array(
        'name' => 'required|string',
    );
    /* Delete rules falta */
    public static $rules_remove = array(
        "id"=>"required",
    );


    // Definir relaciones y atributos aquí

}
