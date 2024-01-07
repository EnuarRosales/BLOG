<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasarellaPago extends Model
{
    use HasFactory;
    
    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];
}
