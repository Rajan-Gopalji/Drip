<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function men(Request $request)
    {
        $posts = Post::filter($request)->latest()->paginate(99);

        return view('posts.men', compact('posts'));
    }

    public function women(Request $request)
    {
        $posts = Post::filter($request)->latest()->paginate(99);
        return view('posts.women', compact('posts'));
    }

}
