<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FieldScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void{
        \Log::info('FieldScope');
        \Log::info('FieldScope: '.$model->getTable());
        \Log::info('Builder: '.$builder);
        $builder->where('display_list', 'show')->orderBy('order', 'asc');
    }
}
