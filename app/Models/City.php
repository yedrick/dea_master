<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model{

    protected $table = 'cities';
    protected $with = [];
    public $timestamps=true;

    /* Create rules */
    public static $rules_created = array(
        'name' => 'required|string|unique:cities,name',
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
    public function countries() {
        return $this->belongsTo(Country::class , 'country_id');
    }
}
