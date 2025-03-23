<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = 'menus';
    protected $with = [];
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'label',
        'is_multi',
        'is_node',
        'order',
        'parent_id',
        'icon',
        'permission',
        'role'
    ];

    protected $casts = [
        'is_multi' => 'boolean',
    ];

    /* Create rules */
    public static $rules_created = array();
    /* Updating rules */
    public static $rules_updated = array();
    /* Delete rules falta */
    public static $rules_remove = array();

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    // Definir relaciones y atributos aquí
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
