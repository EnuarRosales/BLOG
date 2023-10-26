<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Impuesto extends Model
{
    use HasFactory, SoftDeletes;
    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

    //RELACION UNO A MUCHOS
    public function pagos()
    {
        return $this->hasMany('App\Models\Pago');
    }
}
