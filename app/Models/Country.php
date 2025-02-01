<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model{

    protected $table = 'countries';
    protected $with = [];
    public $timestamps=true;

        /* Create rules */
        public static $rules_created = array(
            'name' => 'required|string|unique:countries,name',
            'code' => 'required|string',
        );
            /* Updating rules */
        public static $rules_updated = array(
            'name' => 'required|string|max:255',
            'code' => 'required|string',
        );
        /* Delete rules falta */
        public static $rules_remove = array(
            "id"=>"required",
        );

    // Definir relaciones y atributos aquí

}
