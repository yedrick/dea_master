<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model{

    protected $table = 'country';
    protected $with = [];
    public $timestamps=true;

    //public static $formCreateRequest = '\App\Http\Requests\City\CityCreateRequest';
    // public static $formUpdateRequest = 'App\Http\Requests\City\CityCreateRequest';

        /* Create rules */
    public static $rules_created = array(
	);
		/* Updating rules */
    public static $rules_updated = array(
    );
    /* Delete rules falta */
    public static $rules_remove = array(
    );


    // Definir relaciones y atributos aquí

}
