<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function men()
    {
        $posts = Post::latest()->paginate(99);

        return view('posts.men', compact('posts'));
    }

    public function women()
    {
        $posts = Post::latest()->paginate(99);;
        return view('posts.women', compact('posts'));
    }

}
