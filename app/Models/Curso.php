<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use HasFactory, SoftDeletes;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

   // protected $table ='users'; // ESTO ES LO MEJOR YA QUE QUITA LA CONVERCION Y PODEMOS ENTRAR A ADMINISTRAR CUALQUIER TABLA
}
