<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionRoom extends Model
{
    use HasFactory;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

    //RELACION UNO A MUCHO (INVERSA)
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //RELACION UNO A MUCHO (INVERSA)#2
    public function asignacionRoom(){
        return $this->belongsTo('App\Models\AsignacionRoom');

    }



}
