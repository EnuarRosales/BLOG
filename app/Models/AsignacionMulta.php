<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionMulta extends Model
{
    use HasFactory;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];
    
    //RELACION UNO A MUCHO (INVERSA)
    public function tipoMulta(){
        return $this->belongsTo('App\Models\TipoMulta');
    }
}
