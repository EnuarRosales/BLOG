<?php

namespace App\Http\Livewire\Admin\Posts;

use Livewire\Component;
use App\Models\Post;

class Index extends Component
{

    protected $listeners = ['postCreated' => 'render'];

    public function render()
    {

        $posts = Post::all();
        //dd($posts);

        return view('livewire.admin.posts.index', compact('posts'))->extends('template.index')->section('content');
    }
}
