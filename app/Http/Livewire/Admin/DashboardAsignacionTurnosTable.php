<?php

namespace App\Http\Livewire\Admin;

use App\Models\AsignacionTurno;
use Livewire\Component;

class DashboardAsignacionTurnosTable extends Component
{
    public $asignacionTurnos = null;

    protected $listeners = ['renderAsignacionTurnos' => 'refresh'];

    public function render()
    {
        $this->asignacionTurnos = AsignacionTurno::select(['id', 'user_id', 'turno_id'])
                                ->with('turno', 'user')
                                ->get();

        return view('livewire.admin.dashboard-asignacion-turnos-table');
    }
}
