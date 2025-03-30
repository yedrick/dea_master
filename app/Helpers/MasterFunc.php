<?php

namespace App\Helpers;

class MasterFunc
{

    //filtrar datos segun el nodo y roles , etc
    public static function filterNode($node, $data)
    {
        if (!$node) return $data;
        if ($node->name == 'people') {
            //odernar por los ultimos  registros
            $data = $data->orderBy('created_at', 'desc');
            return $data;
        } else {
            return $data;
        }
    }
}
