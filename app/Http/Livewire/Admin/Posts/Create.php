<?php

namespace App\Http\Livewire\Admin\Posts;

use Livewire\Component;
use App\Models\Post;


class Create extends Component
{
    public $titulo;
    public $contenido;

    public function save()
    {
        $this->validate([
            'titulo' => 'required',
            'contenido' => 'required',
        ]);

        Post::create([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
        ]);


        $this->emit('redibujarTabla');
        $this->emit('scriptRecargado');
        // Limpiar los campos después de guardar
        $this->titulo = '';
        $this->contenido = '';

        // Cerrar el modal después de guardar
        $this->dispatchBrowserEvent('close-modal');
    }   

    public function render()
    {
        return view('livewire.admin.posts.create');
    }
}
