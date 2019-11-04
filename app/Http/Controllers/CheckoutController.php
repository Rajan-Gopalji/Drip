<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Post;
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
//        $mImage = DB::table('multi_image')->where('post_id', $user)->pluck('image');

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

//    public function postCheckout(Request $request, User $user)
//    {
//
////        $user = auth()->user()->id;
////        if (!session()->has('cart')) {
////            return redirect("/profile/{$user}/cart");
////        }
//
////        $oldCart = session()->get('cart');
////        $cart = new Cart($oldCart);
//
//
//        Stripe::setApiKey('sk_test_j9A7K9YwmDWz3k52TTY1xtI100lwfAZcfa');
//        try {
//            Charge::create(array(
//                "amount" => $totalShipping * 100,
//                "currency" => "usd",
//                "source" => $request->input('stripeToken'), // obtained with Stripe.js
//                "description" => "Test Charge"
//            ));
//        } catch (\Exception $e) {
//            return redirect("/profile/{$user}/cart")->with('error', $e->getMessage());
//        }
//        session()->forget('cart');
//        return redirect()->route('posts.men')->with('success', 'Successfully purchased products!');
//    }

}
