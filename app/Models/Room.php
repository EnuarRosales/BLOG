<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVAb
    protected $guarded = [];

    //RELACION UNO A MUCHOS
    public function asignacionRoom(){
        return $this->hasMany('App\Models\AsignacionRoom');
    }



}
