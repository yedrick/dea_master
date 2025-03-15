<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{

    protected $table = 'peoples';
    protected $with = [];
    public $timestamps = true;

    /* Create rules */
    public static $rules_created = array(
        'first_name' => 'required|string',
        'paternal_last_name' => 'required|string',
        'maternal_last_name' => 'required|string',
        'email' => 'required|string|unique:peoples,email',
        'phone_number' => 'required|string|unique:peoples,phone_number',
        'gender' => 'required|in:M,F',
        'birth_date' => 'required|date',

        'zone_id' => 'required|integer|exists:zones,id',
        'profession_id' => 'required|integer|exists:professions,id|unique:professions,name',
        'civil_status_id' => 'required|integer|exists:civil_statuses,id|unique:civil_statuses,name',
        'membership_status_id' => 'nullable|integer|exists:membership_status,id|unique:membership_status,name',
        'city_id' => 'required|integer|exists:cities,id',
        'ministry_id' => 'required|array',
        'dea' => 'nullable|in:Si,No',

        'assistant' => 'required|in:Creyente,Visitante',
        'membership' => 'required|in:Bautismo,Transferencia,Ninguno',
        'date_membership' => 'nullable|date',
        'church' => 'nullable|string',

        'image' => 'nullable|mimes:jpg,jpeg,bmp,png',

    );
    /* Updating rules */
    public static $rules_updated = array(
        'first_name' => 'required|string',
        'paternal_last_name' => 'required|string',
        'maternal_last_name' => 'required|string',
        'email' => 'required|string',
        'phone_number' => 'required|string',
        'gender' => 'required|in:M,F',
        'birth_date' => 'required|date',

        'assistant' => 'required|in:Creyente,Visitante',
        'membership' => 'required|in:Bautismo,Transferencia,Ninguno',
        'date_membership' => 'nullable|date',
        'church' => 'nullable|string',
        'dea' => 'nullable|in:Si,No',

        'profession_id' => 'required|integer|exists:professions,id',
        'civil_status_id' => 'required|integer|exists:civil_statuses,id',
        'zone_id' => 'required|integer|exists:zones,id',
        'city_id' => 'required|integer|exists:cities,id',
        'ministry_id' => 'required|array',
        'membership_status_id' => 'nullable|integer|exists:membership_status,id',

        'image' => 'nullable|mimes:jpg,jpeg,bmp,png',
    );
    /* Delete rules falta */
    public static $rules_remove = array(
        "id" => "required",
    );

   

    // Definir relaciones y atributos aquí
    public function zones()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
    public function professions()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }
    public function civil_statuses()
    {
        return $this->belongsTo(CivilStatus::class, 'civil_status_id');
    }
    public function membership_status()
    {
        return $this->belongsTo(MembershipStatus::class, 'membership_status_id', 'id');
    }
    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function ministries()
    {
        return $this->belongsTo(Ministry::class, 'ministry_id');
    }
}
