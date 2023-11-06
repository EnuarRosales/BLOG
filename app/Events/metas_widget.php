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
        $this->datoMasReciente = Meta::orderBy('created_at', 'desc')->first();
        $idMeta = $this->datoMasReciente->id;
        $registroProduccion = ResgistroProducido::where('meta_id', $idMeta)
            ->sum('valorProducido');
        $valorMeta = $this->datoMasReciente->valor;

        $porcentajeMeta = ($registroProduccion * 100) / $valorMeta;

        //dd($this->progreso);
        return [
            'progreso' => $porcentajeMeta,
            'estatico' => 5000,
            'valormeta' => $valorMeta,
            'meta' => $this->datoMasReciente,
            // Otros datos que quieras transmitir...
        ];
    }
}
