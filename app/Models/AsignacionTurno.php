<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionTurno extends Model
{
    use HasFactory;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

    //RELACION UNO A MUCHOS INVERSA
    public function turno(){
        return $this->belongsTo('App\Models\Turno');
    }

    //RELACION UNO A MUCHOS INVERSA
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
   
}
