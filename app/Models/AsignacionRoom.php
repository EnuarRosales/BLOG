<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsignacionRoom extends Model
{
    use HasFactory, SoftDeletes;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

    //RELACION UNO A MUCHO (INVERSA)
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //RELACION UNO A MUCHO (INVERSA)#2
    public function room(){
        return $this->belongsTo('App\Models\Room');

    }



}
