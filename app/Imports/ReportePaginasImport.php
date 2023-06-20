<?php

namespace App\Imports;

use App\Models\ReportePagina;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReportePaginasImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ReportePagina([

            // ESTO NOS PERMITE EXPORTAR EL EXCEL
            //IZQUIERDA ATRIBUTOS BD DERECHA DATOS EXCEL
            'fecha' => $row['fecha'],
            'Cantidad' => $row['cantidad'],
            'user_id' => 51,
            'pagina_id' => 1,
            
            //
        ]);
    }
}
