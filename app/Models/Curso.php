<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

   // protected $table ='users'; // ESTO ES LO MEJOR YA QUE QUITA LA CONVERCION Y PODEMOS ENTRAR A ADMINISTRAR CUALQUIER TABLA
}
