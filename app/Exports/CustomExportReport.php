<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomExportReport implements WithMultipleSheets {
    protected static $data = [];
    protected static $headers = [];
    protected static $tableData = [];

    public static function setHeader($headers) {
        self::$headers = $headers;
    }

    public static function setTableData($tableData) {
        self::$tableData = $tableData;
    }

    public function sheets(): array {
        return [
            new class(self::$headers, self::$tableData) implements FromCollection, WithTitle, WithStyles {
                protected $headers;
                protected $tableData;

                public function __construct(array $headers, array $tableData) {
                    $this->headers = $headers;
                    $this->tableData = $tableData;
                }

                public function collection() {
                    $data = [];

                    // Agregar los encabezados
                    foreach ($this->headers as $headerRow) {
                        $data[] = $headerRow;  // Estos son los encabezados
                    }

                    // Insertar una fila vacía después de los encabezados
                    $data[] = [];

                    // Agregar los datos de la tabla
                    foreach ($this->tableData as $row) {
                        $data[] = $row;
                    }

                    // Retornar la colección de datos
                    return new Collection($data);
                }

                public function title(): string {
                    return 'Reporte Personalizado';
                }

                public function styles(Worksheet $sheet) {
                    // Ajustar todo el texto a la celda (autoajuste de texto)
                    $sheet->getDefaultColumnDimension()->setAutoSize(true);

                    // Estilo de la fuente y alineación para toda la hoja
                    $sheet->getStyle('A1:Z1000')->getFont()->setName('Arial')->setSize(10);
                    $sheet->getStyle('A1:Z1000')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

                    // Estilo para los encabezados personalizados (negrita)
                    foreach (range(1, count($this->headers)) as $rowIndex) {
                        $sheet->getStyle("A$rowIndex:Z$rowIndex")->getFont();
                    }

                    // Estilo para la fila de títulos de la tabla en negrita
                    $rowStart = count($this->headers) + 1;  // La fila después de los encabezados
                    $sheet->getStyle("A$rowStart:Z$rowStart")
                        ->getFont()->setBold(true);
                }
            },
        ];
    }
}
