<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model{

    protected $table = 'city';
    protected $with = [];
    public $timestamps=true;

    // public static $formCreateRequest = '\App\Http\Requests\City\CityCreateRequest';
    // public static $formUpdateRequest = 'App\Http\Requests\City\CityCreateRequest';

        /* Create rules */
    public static $rules_create = array(
        "name"=>"required|string|max:255",
        "state_id"=>"required|integer",
	);
		/* Updating rules */
    public static $rules_edit = array(
        "id"=>"required",

    );
        /* Read rules */
    public static $rules_read = array(
        "id"=>"required",
    );
        /* Delete rules */
    public static $rules_remove = array(
        "id"=>"required",
    );


    // Definir relaciones y atributos aquí

    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

}
