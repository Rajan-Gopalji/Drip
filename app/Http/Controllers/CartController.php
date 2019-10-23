<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(User $user, Post $post)
    {
        $this->authorize('update', $user->profile);

        $user = auth()->user()->cart()->pluck('carts.post_id');
        $posts = Post::whereIn('id', $user)->paginate(5);
        $mImage = DB::table('multi_image')->where('post_id', $user)->pluck('image');

//        $cart_user_id = DB::table('carts')->pluck('user_id');
//        $cart_post_id = DB::table('carts')->pluck('post_id');
//        $user_id = $user->id;

//        $posts2 = DB::select( DB::raw("SELECT * FROM posts WHERE user_id = :user_id"));
//        $posts = DB::select( DB::raw("SELECT * FROM posts AS p
//                                        JOIN carts AS c ON c.post_id=p.id
//                                        WHERE :user_id = :cart_user_id"), array(
//            'cart_user_id' => $cart_user_id, 'user_id' => $user_id,
//        ));

//        dd($cart);

//        $posts = Post::whereIn('user_id', $cart_user_id);
//        dd($posts);

        return view('checkout.cart', compact('user', 'posts', 'mImage'));
    }
}
