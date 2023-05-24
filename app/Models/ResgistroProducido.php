<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResgistroProducido extends Model
{
    use HasFactory;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

     //RELACION UNO A MUCHOS INVERSA
     public function meta(){
        return $this->belongsTo('App\Models\Meta');
    }

     //RELACION UNO A MUCHOS INVERSA
     public function user(){
        return $this->belongsTo('App\Models\User');
    }


    public function pagina(){
        return $this->belongsTo('App\Models\Pagina','pagina_id');
    }

}
