<?php

namespace App\Http\Livewire\Admin\Posts;

use Livewire\Component;
use App\Models\Post;

class Table extends Component
{


    public $posts;
    public $data;
    protected $listeners = ['ReloadTable' => 'updateTable'];

    public function updateTable($data)
    {
        $this->posts = $data['posts'];
    }

    public function __construct($data)
{
    $this->data = $data;
}
    public function mount(){
        $this->posts = Post::all();

    }

    public function render()
    {
        return view('livewire.admin.posts.table');
    }
}
