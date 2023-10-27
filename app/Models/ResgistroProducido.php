<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResgistroProducido extends Model
{
    use HasFactory, SoftDeletes;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

     //RELACION UNO A MUCHOS INVERSA
     public function meta(){
        return $this->belongsTo('App\Models\Meta','meta_id');
    }

     //RELACION UNO A MUCHOS INVERSA
     public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }


    //RELACION UNO A MUCHOS INVERSA
    public function pagina(){
        return $this->belongsTo('App\Models\Pagina','pagina_id');
    }

}
