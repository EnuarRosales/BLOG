<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];
    
     //RELACION UNO A MUCHOS     
     public function registroProducidos(){
        return $this->hasMany('App\Models\RegistroProducido');
    }
}
