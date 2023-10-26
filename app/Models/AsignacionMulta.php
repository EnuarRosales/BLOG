<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsignacionMulta extends Model
{
    use HasFactory, SoftDeletes;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

    //RELACION UNO A MUCHO (INVERSA)
    public function tipoMulta(){
        return $this->belongsTo('App\Models\TipoMulta','tipoMulta_id');
    }

    //RELACION UNO A MUCHO (INVERSA)
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

}
