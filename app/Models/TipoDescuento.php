<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDescuento extends Model
{
    use HasFactory;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];
    
    //RELACION UNO A MUCHOS     
    public function descuentos(){
        return $this->hasMany('App\Models\Descuento');
    }

    
}
