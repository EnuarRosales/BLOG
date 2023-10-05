<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagina extends Model
{
    use HasFactory, SoftDeletes;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

     //RELACION UNO A MUCHOS INVERSA
    //  public function tipoMonedaPagina(){
    //     return $this->belongsTo(TipoUsuario::class,'tipoMoneda_id');
    // }

    public function tipoMonedaPagina(){
        return $this->belongsTo('App\Models\TipoMonedaPagina','tipoMoneda_id');
    }


    //RELACION UNO A MUCHOS
    public function registroProducidos(){
        return $this->hasMany('App\Models\RegistroProducido');
    }

    //RELACION DE UNO A MUCHOS
    public function reportePaginas()
    {
        return $this->hasMany('App\Models\ReportePagina');
    }



}
