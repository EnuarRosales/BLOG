<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoUsuario extends Model
{
    use HasFactory, SoftDeletes;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];


    //RELACION DE UNO A MUCHOS
    public function users(){
        return $this->hasMany('App\Models\User');
    }


    // public function users(){
    //     return $this->hasMany(User::class);
    // }


}
