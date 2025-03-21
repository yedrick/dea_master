<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldOption extends Model {

    protected $table = 'field_options';
    public $timestamps = true;

    public $translatedAttributes = ['label'];
    protected $fillable = ['parent_id','name','label'];

    /* Creating rules */
    public static $rules_create = array(
        'name'=>'required',
        'active'=>'required',
        'label'=>'required',
    );

    /* Updating rules */
    public static $rules_edit = array(
        'name'=>'required',
        'active'=>'required',
        'label'=>'required',
    );

    public function field() {
        return $this->belongsTo('Solunes\Master\App\Field', 'parent_id');
    }

}
