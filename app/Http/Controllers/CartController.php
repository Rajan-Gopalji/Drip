<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Post;
use App\Trade;
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

        $total = 0;
        foreach ($posts as $postPrice){
            $total = $total + $postPrice->price;
        }

        $totalShipping = $total;
        if ($total < 100){
            $totalShipping = $totalShipping + 4.99;
        }

        return view('checkout.cart', compact('user', 'posts', 'mImage', 'total', 'totalShipping'));
    }

    public function destroy($post_id)
    {
        $user_id = auth()->user()->id;
        Cart::where('post_id', $post_id)->delete();
        return back()->with('success', 'Post Updated');
    }

    public function clear()
    {
        $user_id = auth()->user()->id;
        $posts = DB::select( DB::raw("DELETE FROM carts WHERE user_id = '$user_id'"));


        return back()->with('success', 'Post Updated');
    }

    public function add($post_id)
    {
        $user_id = auth()->user()->id;
        $trade_exists = Trade::where(['user_id' => $user_id, 'post_id_tradee' => $post_id])->exists();
        $duplicate = Cart::where(['user_id' => $user_id, 'post_id' => $post_id])->exists();

        if ($trade_exists == true)
        {
            Trade::where(['user_id' => $user_id, 'post_id_tradee' => $post_id])->delete();
        }

        if ($duplicate == true)
        {
            $this->destroy($post_id);
            return back()->with('success', 'Post Updated');
//            return redirect()->route( 'cart.index',[$user_id]);
        } else {
            Cart::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
            ]);
        }
        return redirect()->route( 'cart.index',[$user_id] );
    }
}
