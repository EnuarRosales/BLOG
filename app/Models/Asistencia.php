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

    // public function getControlAttribute()
    // {
    //     $horaLlegada = strtotime($this->mi_hora);
    //     $horaIngreso = $this->user->asignacionTurnos->first() ? strtotime($this->user->asignacionTurnos->first()->turno->horaIngreso) : 0;
    //     if ($horaIngreso === 0) {
    //         return 'Sin asignación de turno';
    //     }
    //     // Calcular la diferencia en segundos entre la hora de llegada y la hora de ingreso
    //     $diferenciaSegundos = $horaLlegada - $horaIngreso;

    //     if ($diferenciaSegundos < 0) {
    //         // El usuario llega antes de la hora de entrada (A tiempo)
    //         return 'A tiempo';
    //     } elseif ($diferenciaSegundos <= 900) {
    //         // El usuario llega después de la hora de entrada pero dentro de los 15 minutos de gracia (Sobre el tiempo)
    //         return 'Sobre el tiempo';
    //     } else {
    //         // El usuario llega tarde (Retardado)
    //         return 'Retardado';
    //     }
    // }
}
