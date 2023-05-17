<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

    //RELACION UNO A MUCHOS INVERSA
    public function tipoDescuento(){
        return $this->belongsTo('App\Models\TipoDescuento','tipoDescuento_id');
    }

    //RELACION UNO A MUCHOS INVERSA
    public function user(){
        return $this->belongsTo('App\Models\User');
    }   
    

    //RELACION UNO A MUCHOS 
    public function descontado()    {
        return $this->hasMany('App\Models\Descontado');
    }



}
