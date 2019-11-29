<?php

namespace App\Http\Controllers;

use App\Post;
use App\Trade;
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
        return view('checkout.trade', compact('user', 'item', 'itemTrade', 'postId'));
    }

    public function myTradeIndex()
    {
        //Select user_id_tradee where auth user in trade table and pull post from post via post.id and trade.post_id_tradee and trade.post_id_trader
        $user_id = auth()->user()->id;
        //$offer = SELECT * FROM trade WHERE user_id_tradee = $user_id_tradee

        $itemTrade = auth()->user()->trade()->pluck('trades.post_id_trader');
        $countOutgoing = \App\Trade::where('user_id', $user_id)->count();
        $posts = Post::whereIn('id', $itemTrade)->paginate(5);

//        $itemTradee =  DB::select(DB::raw('SELECT post_id_tradee FROM trades WHERE post_id_trader = :itemTrade'), array('itemTrade' => $itemTrade));
        $itemTradee = auth()->user()->trade()->pluck('trades.post_id_tradee');
//        $itemTradee2 =  DB::select(DB::raw('SELECT * FROM posts WHERE id = :itemTrade'), array('itemTrade' => $itemTradee));
        $itemTradee2 = Post::whereIn('id', $itemTradee)->paginate(5);


        $tradeStatusYourOffer = DB::select(DB::raw('SELECT * FROM trades WHERE user_id = :user_id'), array('user_id' => $user_id));
        foreach ($tradeStatusYourOffer as $yourOffer)
        {

        }
        $tradeStatusOffer = DB::select(DB::raw('SELECT * FROM trades WHERE user_id_tradee = :user_id'), array('user_id' => $user_id));
        foreach ($tradeStatusOffer as $offer)
        {

        }
//        $otherEndTrader = DB::select(DB::raw('SELECT post_id_trader FROM trades WHERE user_id_tradee = :user_id'), array('user_id' => $user_id));

        $otherEndPost = Trade::whereIn('user_id_tradee', [$user_id])->paginate(5);

        $countIncoming = \App\Trade::where('user_id_tradee', $user_id)->count();
        foreach ($otherEndPost as $traders_post)
        {
            $theywantid = $traders_post->post_id_trader;
            $otherEndPostFulltheywant = Post::whereIn('id', [$theywantid])->paginate(5);

            $theyllgive = $traders_post->post_id_tradee;
            $otherEndPostFulltheyllgive = Post::whereIn('id', [$theyllgive])->paginate(5);
//            dd($otherEndPostFulltheyllgive);

//            dd($theyllgive);
//            $otherEndPostFull = Post::whereIn('id', [$id])->paginate(5);
//            dd($otherEndPostFull);
        }

//        $otherEndPost = Post::whereIn('id', $otherEndTrader)->paginate(5);
//        $otherEndPost = DB::select(DB::raw('SELECT * FROM posts WHERE id = :post_id_trader'), array('post_id_trader' => $otherEndTrader));


        return view('profiles.myTrade', compact('user', 'posts', 'itemTrade', 'itemTradee2', 'yourOffer', 'offer', 'otherEndPostStatus', 'otherEndPostFull', 'otherEndPostFulltheywant', 'otherEndPostFulltheyllgive', 'countIncoming', 'countOutgoing'));
    }

    public function store(Request $request, Post $post)
    {

        $post_id_tradee = $post->id;
        $user_id_tradee = $post->user_id;
        $user_id_trader = auth()->user()->id;

        $data = request()->validate([
            'post_id_trader' => 'required',
        ]);

        auth()->user()->trade()->create([
            'user_id_tradee' => $user_id_tradee,
            'user_id' => $user_id_trader,
            'post_id_tradee' => $post_id_tradee,
            'post_id_trader' => $data['post_id_trader'],
            'accepts' => 'p',
        ]);

        return redirect(auth()->user()->id . '/myTrades');
    }

    public function acceptTrade($post_id_trader, $post_id_tradee)
    {
        $status = 'y';
        DB::select(DB::raw('UPDATE trades SET accepts = :status WHERE  post_id_trader = :post_id_trader'), array('post_id_trader' => $post_id_trader, 'status' => $status));
        DB::table('posts')
            ->whereIn('id', [$post_id_trader, $post_id_tradee])
            ->update(['sold' => $status]);

        return back()->with('success', 'Trade Accepted');
    }

    public function declineTrade($post_id)
    {
        $decline = 'n';
        DB::select(DB::raw('UPDATE trades SET accepts = :decline WHERE  post_id_trader = :post_id_trader'), array('post_id_trader' => $post_id, 'decline' => $decline));

        return back()->with('success', 'Trade Declined');
    }

    public function renegotiate(Post $post)
    {
        $this->cancel($post->id);

        return redirect()->route('trade.index', ['post' => $post->id]);
    }

    public function cancel($post_id)
    {
        Trade::where('post_id_tradee', $post_id)->delete();

        return back()->with('success', 'Trade Cancelled');
    }

}
