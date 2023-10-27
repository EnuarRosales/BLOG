<?php

namespace App\Imports;

use App\Models\Pagina;
use App\Models\ReportePagina;
use App\Models\User;
use Illuminate\Validation\Rules\RequiredIf;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class ReportePaginasImport implements ToModel, WithHeadingRow, WithValidation

{

    
    // CON ESTA VARIABLE Y CON EL CONSTRUCTOR LOGRAMOS PASAR DEL NOMBRE AL ID, YA QUE LA TABLA RECIBE UN ID
    private $pagina;

    public function __construct()
    {
        $this->pagina = Pagina::pluck('id', 'nombre');
    }

    /**
     * @method metodo para realizar el cargue de los datos del excel
     *
     * @param array $row -> aca llega la fila completa que se requiere validar
     * @return void
     */
    public function model(array $row)
    {
        // $modelo = User::find($row['modelo']);
        $modelo = User::where('cedula',$row['modelo'])->first();
        if (empty($modelo)) {
            return null; // Devuelve null si el modelo no se encuentra.
            // return redirect()->route('admin.reportePaginas.index')->with('info', 'Error porque el modelo no existe.');
        }

        $pagina = Pagina::where('nombre', $row['pagina'])->first();
        if (empty($pagina)) {
            return null; // Devuelve null si el modelo no se encuentra.
            // return redirect()->route('admin.reportePaginas.index')->with('info', 'Error porque el modelo no existe.');
        }

        return new ReportePagina([
            // ESTO NOS PERMITE EXPORTAR EL EXCEL
            // IZQUIERDA ATRIBUTOS BD DERECHA DATOS EXCEL
            'fecha' => $row['fecha'],
            'Cantidad' => $row['cantidad'],
            'TRM' => $row['trm'],
            'user_id' => $modelo->id,
            'pagina_id' => $pagina->id
            //
        ]);
    }




    // CON ESTO VALIDAMOS LAS INFORMACION OJO QUE VA LA INFO DEl  EXCEL
    public function rules(): array
    {
        return [

            'fecha' => [

                'date', //  CON ESTO VALIDAMOS QUE EL VALOR SEA DECIMAL
                'required'
            ],

            'cantidad' => [

                'regex:/^[0-9]+(\.[0-9]{1,2})?$/', //  CON ESTO VALIDAMOS QUE EL VALOR SEA DECIMAL
                'required'
            ],


            'trm' => [

                'regex:/^[0-9]+(\.[0-9]{1,2})?$/', //  CON ESTO VALIDAMOS QUE EL VALOR SEA DECIMAL
                'required'
            ],


            'modelo' => [

                //'numeric', //  CON ESTO VALIDAMOS QUE EL VALOR SEA DECIMAL
                'integer',
                'required'
            ],

            'pagina' => [

                'string', //  CON ESTO VALIDAMOS QUE EL VALOR SEA DECIMAL
                'required'
            ],





        ];
    }
}
