<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model{

    protected $table = 'fields';
    protected $fillable = ['parent_id', 'order', 'name','trans_name','type','display_list','display_item','relation','required','label','placeholder','child_table','relation_cond','value'];
    protected $with = [];
    public $timestamps=true;

        /* Create rules */
    public static $rules_create = array(
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

    public function children(){
        return $this->hasMany(Node::class,'parent_id','id');
    }

    public function parent(){
        return $this->belongsTo(Node::class,'parent_id');
    }


    // Definir relaciones y atributos aquí

}
