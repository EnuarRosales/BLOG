<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsignacionTurno extends Model
{
    use HasFactory, SoftDeletes;
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

    public function turnos()
    {
        return $this->belongsTo(Turno::class, 'turno_id', 'id');
    }


}
