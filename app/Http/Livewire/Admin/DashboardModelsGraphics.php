<?php

namespace App\Http\Livewire\Admin;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DashboardModelsGraphics extends Component
{
    public $count_users_models = 0;
    public $porcentaje_model_actives = 0;

    protected $listeners = ['renderModels' => 'getRenderModels'];

    public function render()
    {
        return view('livewire.admin.dashboard-models-graphics');
    }

    public function mount(){
        $this->getRenderModels();
    }

    public function getRenderModels(){

        try{
            //Log::info('Entry in livewire');
            $this->count_users_models = User::select('id')
                ->join('user_empresa', 'user_empresa.user_id', '=', 'users.id')
                ->whereIn('tipoUsuario_id', [2, 3])
                ->where('active', true)
                ->where('user_empresa.empresa_id', Auth::user()->empresa_id)
                ->count();

            $capacity_model_empresa = Empresa::select(['capacity_models'])->where('id', Auth::user()->empresa_id)->first();


            if($capacity_model_empresa)
                $this->porcentaje_model_actives = ($this->count_users_models * 100) / ($capacity_model_empresa->capacity_models!=0?$capacity_model_empresa->capacity_models:1);

            $this->porcentaje_model_actives = $this->porcentaje_model_actives!=0?number_format($this->porcentaje_model_actives, 2):$this->porcentaje_model_actives;
        } catch (\Exception $exception) {
            Log::error("Error getRenderModels EGC: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
        }
    }
}
