<?php

namespace App\Http\Livewire\Admin\Posts;

use Livewire\Component;
use App\Models\Post;

class Table extends Component
{   

    public $posts;
    protected $listeners = ['postCreated' => 'render'];

    public function actualizarListado()
    {
        $this->posts = Post::all();
        $this->render();
    }

    public function mount(){
        $this->posts = Post::all();
    }
    public function render()
    {
        
        return view('livewire.admin.posts.table');
    }
}
