<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Youth extends Model{

    protected $table = 'youths';
    protected $with = [];
    public $timestamps=true;

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


    // Definir relaciones y atributos aquí

}
