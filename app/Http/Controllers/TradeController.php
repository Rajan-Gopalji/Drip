<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TradeController extends Controller
{
    public function index(User $user, Post $post)
    {
        $user_id = auth()->user()->id;
        $item = DB::select(DB::raw('SELECT * FROM posts WHERE user_id = :user_id'), array('user_id' => $user_id));


        $postId = $post->id;
        $itemTrade = DB::select(DB::raw('SELECT * FROM posts WHERE id = :post_id'), array('post_id' => $postId));
//        dd($itemTrade);
        return view('checkout.trade', compact('user', 'item', 'itemTrade'));
    }

}
