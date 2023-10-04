<?php

namespace App\Http\Livewire\Admin\Posts;

use Livewire\Component;
use App\Models\Post;

class Table extends Component
{   

    protected $listeners = ['postCreated' => 'updateTable'];

    public $posts;

    public function mount()
    {
        // Inicialmente, carga los datos
        $this->posts = Post::all();
    }

    public function updateTable()
    {
        // Actualiza los datos cuando se crea un nuevo post
        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.admin.posts.table');
    }
}
