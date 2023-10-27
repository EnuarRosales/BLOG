<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaModelo extends Model
{
    use HasFactory, SoftDeletes;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA


    protected $attributes = [
        'mayorQue' => 0,
        'porcentaje' => 0,
    ];



    protected $guarded = [];



    // RELACION DE UNO A MUCHOS
    // public function reportePaginas()
    // {
    //     return $this->hasMany('App\Models\ReportePagina');
    // }

}
