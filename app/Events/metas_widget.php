<?php

namespace App\Events;

use App\Models\Meta;
use App\Models\ResgistroProducido;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class metas_widget implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */



        public $datoMasReciente;

    public function __construct()
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('metas_widget');
    }

    public function broadcastAs()
    {
        return 'reload-metas';
    }

    public function broadcastWith()
    {
        $datoMasRecientes = Meta::latest()->take(4)->get();
        $miArray = array(); // Inicializar un array vacío       
        if ($datoMasRecientes->count() > 0) {
            foreach ($datoMasRecientes as $datoMasReciente) {
                $registroProduccion = ResgistroProducido::where('meta_id', $datoMasReciente->id)
                    ->sum('valorProducido');
                $porcentajeMeta = ($registroProduccion * 100) / $datoMasReciente->valor;
                $miArray[] = $datoMasReciente->nombre; //0
                $miArray[] = $porcentajeMeta;          //1
                $miArray[] = $registroProduccion;      //2
                $miArray[] = $datoMasReciente->valor;  //3
            }
        }


        if ($datoMasRecientes->count() < 4) {
            $datos = 4 - $datoMasRecientes->count();

            for ($i = 0; $i < $datos; $i++) {
                $miArray[] = "No hay datos para mostarar"; //0
                $miArray[] = 0; //1
                $miArray[] = 0; //2
                $miArray[] = 0; //3

            }
        }
        return [

            'historialmetas' => $miArray
            // Otros datos que quieras transmitir...
        ];
    }
}
