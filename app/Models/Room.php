<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVAb
    protected $guarded = [];

    //RELACION UNO A MUCHOS     
    public function asignacionRoom(){
        return $this->hasMany('App\Models\AsignacionRoom');
    }



}
