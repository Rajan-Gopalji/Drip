<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function men()
    {
        $posts = Post::paginate(5);;

        return view('posts.men', compact('posts'));
    }

    public function women()
    {
        return view('posts.women');
    }

}
