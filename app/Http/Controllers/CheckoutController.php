<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Post;
use App\User;
use DB;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Cart $cart, User $user)
    {
        $this->authorize('update', $user->profile);

        $user = auth()->user()->cart()->pluck('carts.post_id');
        $posts = Post::whereIn('id', $user)->paginate(5);
        $mImage = DB::table('multi_image')->where('post_id', $user)->pluck('image');

        $total = 0;
        foreach ($posts as $postPrice){
            $total = $total + $postPrice->price;
        }

        $totalShipping = $total;
        if ($total < 100){
            $totalShipping = $totalShipping + 4.99;
        }

        return view('checkout.checkout', compact('user', 'posts', 'total', 'totalShipping'));
    }

    public function getData(Request $request)
    {
        return $request->all();
    }
}
