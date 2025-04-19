<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Youth extends Model{

    protected $table = 'youths';
    protected $with = [];
    public $timestamps=true;
    protected $appends = ['imagen_numero', 'imagen_normal','foto','pts'];

    /* Create rules */
    public static $rules_created = array(
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'birth_date' => 'required|date',
        'password' => 'required|string',

        'phone_number' => 'required|string|unique:youths,phone_number',
        'discipleship' => 'required|in:Si,No',
        'baptized' => 'required|in:Si,No',
        'career' => 'required|string',

        'image'=> 'nullable|mimes:jpg,jpeg,bmp,png',

    );
        /* Updating rules */
    public static $rules_updated = array(
        'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required|date',
            'password' => 'required|string',

            'phone_number' => 'required|string',
            'discipleship' => 'required|in:Si,No',
            'baptized' => 'required|in:Si,No',
            'career' => 'required|string',

            'image'=> 'nullable|mimes:jpg,jpeg,bmp,png',
        );
    /* Delete rules falta */
    public static $rules_remove = array(
        "id"=>"required",
    );

    protected $hidden = [
        'password',
    ];



    // Definir relaciones y atributos aquí

    // atributo name completo
    public function getNameAttribute() {
        return $this->first_name.' '.$this->last_name;
    }
    
    public function getFotoAttribute()
    {
        return asset('img/youngs/original/' . $this->image.'.jpg');
    }
    
    public function getImagenNumeroAttribute()
    {
        return asset('img/youngs/text/' . $this->image);
    }

    public function getImagenNormalAttribute()
    {
        return asset('img/youngs/original/' . $this->image);
    }
    
    public function youthScores()
    {
        return $this->hasMany(YouthScore::class);
    }

    // Accesor para obtener total de puntos
    public function getPtsAttribute()
    {
        return $this->youthScores->sum('pts');
    }
}
