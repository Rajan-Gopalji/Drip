<?php

namespace App\Http\Controllers;

use App\Cart;
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
//        $mImage = DB::table('multi_image')->where('post_id', $user)->pluck('image');

        $total = 0;
        foreach ($posts as $postPrice){
            $total = $total + $postPrice->price;
        }

        $totalShipping = $total;
        if ($total < 100){
            $totalShipping = $totalShipping + 4.99;
        }
//        dd($total);
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

        return view('checkout.cart', compact('user', 'posts', 'mImage', 'total', 'totalShipping'));
    }

    public function destroy($post_id)
//    public function destroy(User $user, Post $post)
    {
        $user_id = auth()->user()->id;
//        $post = Post::where('id', $id);
//        $post->delete();
//        return redirect(back());
        Cart::where('post_id', $post_id)->delete();
//        Cart::destroy($post_id);
//        dd($post);
//        return redirect("/profile/{$user->id}/manage")->with('success', 'Post Updated');
        return back()->with('success', 'Post Updated');
    }

    public function clear()
    {
        $user_id = auth()->user()->id;

        $posts = DB::select( DB::raw("DELETE FROM carts WHERE user_id = '$user_id'"));
//        dd($posts);

        return back()->with('success', 'Post Updated');
    }

    public function add($post_id)
    {
        $user_id = auth()->user()->id;
        $duplicate = Cart::where(['user_id' => $user_id, 'post_id' => $post_id])->exists();
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
