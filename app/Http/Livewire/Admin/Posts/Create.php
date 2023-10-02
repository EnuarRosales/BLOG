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
        Post::create([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido
        ]);

        $this->emit('actualiza');
        return redirect()->route('admin.posts.index');

    }

    public function render()
    {
        return view('livewire.admin.posts.create')->extends('template.index')->section('content');
    }
}
