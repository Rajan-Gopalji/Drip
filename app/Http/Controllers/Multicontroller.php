<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class Multicontroller extends Controller
{
    public function index()
    {
        $mImage = DB::table('multi_image')->get();
        return view('posts.index', compact('mImage'));

    }
}
