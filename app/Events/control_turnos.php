<?php

namespace App\Events;

use App\Models\AsignacionTurno;
use App\Models\Empresa;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class control_turnos implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('control_turnos');
    }

    public function broadcastAs(){
        return 'reload-turnos';
    }

    public function broadcastWith()
    {
        $capacidadRooms = Empresa::value('number_rooms');
        $error = " ";
        if ($capacidadRooms === null) {
            $capacidadRooms = 0;
            $error = "Favor configura la empresa";
        };

        if ($capacidadRooms > 0) {
            $turnosManana = AsignacionTurno::whereHas('turno', function ($query) {
                $query->where('nombre', 'Mañana');
            })->count();
            $mananaPorcentaje = ($turnosManana * 100) / $capacidadRooms;

            $turnosTarde = AsignacionTurno::whereHas('turno', function ($query) {
                $query->where('nombre', 'Tarde');
            })->count();
            $tardeProcentaje = ($turnosTarde * 100) / $capacidadRooms;

            $turnosNoche = AsignacionTurno::whereHas('turno', function ($query) {
                $query->where('nombre', 'Noche');
            })->count();
            $nochePorcentaje = ($turnosNoche * 100) / $capacidadRooms;
        } else {
            $mananaPorcentaje = 0;
            $turnosManana = 0;
            $tardeProcentaje = 0;
            $turnosTarde = 0;
            $nochePorcentaje = 0;
            $turnosNoche = 0;
        }

        return  array($mananaPorcentaje, $turnosManana, $tardeProcentaje, $turnosTarde, $nochePorcentaje, $turnosNoche, $error);
    }
}
