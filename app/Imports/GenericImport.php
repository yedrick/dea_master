<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\Model;

class GenericImport implements ToCollection,WithHeadingRow{
    protected $model;
    protected $mappings;
    /**
     * Constructor de la clase para recibir el modelo y las columnas a mapear.
     *
     * @param  string  $model
     * @param  array  $mappings
     */
    public function __construct(string $modelClass, array $mappings){
        // Instancia el modelo dinámicamente
        $this->model = new $modelClass;
        $this->mappings = $mappings;
    }

    public function collection(Collection $rows){
        \Log::info('importing data');
        foreach ($rows as $row) {
            $mappedRow = [];

            foreach ($this->mappings as $excelColumn => $dbColumn) {
                if ($dbColumn === 'name') {
                    // Combina first_name y last_name o asigna 'Sin nombre' si ambos están vacíos
                    $firstName = $row['first_name'] ?? '';
                    $lastName = $row['last_name'] ?? '';
                    $mappedRow[$dbColumn] = !empty(trim("$firstName $lastName"))
                        ? trim("$firstName $lastName")
                        : "Sin nombre";
                } elseif ($dbColumn === 'phone') {
                    // Asigna 'Sin teléfono' si phone está vacío
                    $mappedRow[$dbColumn] = $row[$excelColumn] ??0000000000;
                } elseif (isset($row[$excelColumn])) {
                    $mappedRow[$dbColumn] = $row[$excelColumn];
                }
            }

            // Crear el registro en la base de datos si $mappedRow tiene datos
            if (!empty($mappedRow)) {
                $this->model->create($mappedRow);
            }
        }
    }
}
