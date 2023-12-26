<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asistencia extends Model
{
    use HasFactory, SoftDeletes;

    //CON ESTO LOGRAMOS HACER LA ASIGNACION MASIVA
    protected $guarded = [];

    //RELACION UNO A MUCHOS INVERSA
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // OJO QUE LA BORRE
    // public function personal()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }


}
