<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMulta extends Model
{
    use HasFactory;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

    
    //RELACION DE UNO A MUCHOS
    public function asignacioMultas(){
        return $this->hasMany('App\Models\AsignacionMulta');
    }

}
