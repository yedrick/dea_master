<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YouthScore extends Model{

    protected $table = 'youth_scores';
    protected $with = [];
    public $timestamps=true;

    /* Create rules */
    public static $rules_created = array(
        'name' => 'required|string|unique:youths,name',
        'code' => 'required|string',

        'youth_id' => 'required|integer|exists:youths,id',
        'type_score_id' => 'required|integer|exists:type_scores,id',
    );
        /* Updating rules */
    public static $rules_updated = array(
        'name' => 'required|string|max:255',
        'code' => 'required|string',

        'youth_id' => 'required|integer|exists:youths,id',
        'type_score_id' => 'required|integer|exists:type_scores,id',

    );
    /* Delete rules falta */
    public static $rules_remove = array(
        "id"=>"required",
    );


    // Definir relaciones y atributos aquí
    public function youth() {
        return $this->belongsTo(Youth::class, 'youth_id');
    }
    public function type_scores() {
        return $this->belongsTo(TypeScore::class, 'type_score_id');
    }
}
