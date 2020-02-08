<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Post;
use App\Trade;
use App\User;
use DB;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index(Cart $cart, User $user)
    {
        $this->authorize('update', $user->profile);

        $user = auth()->user()->cart()->pluck('carts.post_id');
        $posts = Post::whereIn('id', $user)->paginate(5);

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

    public function purchased(User $user)
    {
        $user_id = auth()->user()->id;

        $this->authorize('update', $user->profile);

        $user = auth()->user()->cart()->pluck('carts.post_id');
        $posts = Post::whereIn('id', $user)->paginate(5);
        foreach($posts as $post) {
            $postsCart = DB::select( DB::raw("UPDATE posts SET sold = 'y' WHERE id = '$post->id'"));
            $cancelTrades = Trade::where(['post_id_tradee' => $post->id])->delete();
            $cancelRequests = Trade::where(['post_id_trader' => $post->id])->delete();
        }

        $clear = DB::select( DB::raw("DELETE FROM carts WHERE user_id = '$user_id'"));


        return view('checkout.purchased');
    }

}
