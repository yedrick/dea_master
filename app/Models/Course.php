<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model{

    protected $table = 'courses';
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


    // scope status true
    public function scopeStatus($query){
        return $query->where('status',true);
    }

    // Definir relaciones y atributos aquí
    public function grade() {
        return $this->belongsTo(Grade::class);
    }

    // ceramos una tributo para el nombre del curso completo
    public function getFullNameAttribute(){
        return $this->grade->name.' '.$this->grade->level->name.' '.$this->name;
    }
}
