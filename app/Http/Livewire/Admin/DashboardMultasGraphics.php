<?php

namespace App\Http\Livewire\Admin;

use App\Models\AsignacionMulta;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DashboardMultasGraphics extends Component
{

    public $count_multas_user = 0;

    protected $listeners = ['renderMultas' => 'getRenderMultas'];

    public function render()
    {
        return view('livewire.admin.dashboard-multas-graphics');
    }

    public function mount ()
    {
        $this->getRenderMultas();
    }
    public function getRenderMultas ()
    {
        try {

            $this->count_multas_user = AsignacionMulta::select(['id'])
                ->count();

        } catch (\Exception $exception) {
            Log::error("Error getRenderMultas EGC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }
}
