<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function men()
    {
        return view('posts.men');
    }

    public function women()
    {
        return view('posts.women');
    }

}
