<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model{

    protected $table = 'students';
    protected $with = [];
    public $timestamps=true;
    public $fillable = [
        'first_name','last_name',
        'ci_number','sex','phone',
        'birthdate'
    ];

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
    public function getNameAttribute(){
       return $this->first_name.' '.$this->last_name;
    }

    

}
