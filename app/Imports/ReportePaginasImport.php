<?php

namespace App\Imports;

use App\Models\Pagina;
use App\Models\ReportePagina;
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
            'TRM' => $row['trm'],
            'user_id' => $row['modelo'],            
            'pagina_id' => $this->pagina[$row['pagina']]
            
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

