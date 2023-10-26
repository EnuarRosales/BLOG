<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use HasFactory, SoftDeletes;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];


    //RELACION UNO A MUCHOS  INVERSA
    // public function descuentos()
    // {
    //     return $this->belongsTo('App\Models\Descuento', 'descuento_id');
    // }


    //RELACION UNO A MUCHOS INVERSA
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    //RELACION UNO A MUCHOS  INVERSA
    public function impuestos()
    {
        return $this->belongsTo('App\Models\Impuesto', 'impuesto_id');
    }
}
