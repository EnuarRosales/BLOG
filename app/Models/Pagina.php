<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    use HasFactory;

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
        return $this->hasMany('App\Models\RegistroProducido','registroProducido_id');
    }
    
    //RELACION DE UNO A MUCHOS      
    public function reportePaginas()
    {
        return $this->hasMany('App\Models\ReportePagina');
    }

    

}
