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
        return view('checkout.trade', compact('user', 'item', 'itemTrade', 'postId'));
    }

    public function myTradeIndexPosts(Request $request)
    {
        $user_id = auth()->user()->id;


        $ItemYouWantId=$request->route('post');
        $itemYouWant = DB::select(DB::raw('SELECT * FROM posts WHERE id = :item_id'), array('item_id' => $ItemYouWantId));


        $youGiveItemId =  \App\Trade::where([
            ['post_id_tradee', $ItemYouWantId],
            ['user_id', $user_id]
            ])->pluck('post_id_trader');
        $youGiveItem = Post::whereIn('id', $youGiveItemId)->paginate(20);
//        $numOffers = $theyGiveItem->count();

        $offers =  \App\Trade::where('post_id_tradee', $ItemYouWantId)->pluck('accepts');
        foreach ($offers as $offer)
        {

        }

//        $countIncoming = \App\Trade::where('user_id_tradee', $user_id)->count();

        return view('profiles.myTradePosts', compact('itemYouWant', 'youGiveItem', 'offer'));
    }

    public function myTradeIndex()
    {
        $user_id = auth()->user()->id;

        $theyWillGive = auth()->user()->trade()->pluck('trades.post_id_tradee');
        $theyWillGiveItem = Post::whereIn('id', $theyWillGive)->paginate(20);

        $tradeStatusOffer = DB::select(DB::raw('SELECT * FROM trades WHERE user_id_tradee = :user_id'), array('user_id' => $user_id));
        foreach ($tradeStatusOffer as $offer)
        {

        }
        $countOutgoing = \App\Trade::where('user_id', $user_id)->count();

        return view('profiles.myTrade', compact('theyWillGiveItem', 'offer', 'countOutgoing'));
    }

    public function ItemRequests(Request $request)
    {
        $user_id = auth()->user()->id;

        $yourItemId=$request->route('post');
        $yourItem = DB::select(DB::raw('SELECT * FROM posts WHERE id = :item_id'), array('item_id' => $yourItemId));

        $theyGiveItemId =  \App\Trade::where('post_id_tradee', $yourItemId)->pluck('post_id_trader');
        $theyGiveItem = Post::whereIn('id', $theyGiveItemId)->paginate(20);
        $numOffers = $theyGiveItem->count();

        $offers =  \App\Trade::where('post_id_tradee', $yourItemId)->pluck('accepts');
        foreach ($offers as $offer)
        {

        }

        $countIncoming = \App\Trade::where('user_id_tradee', $user_id)->count();

        return view('profiles.tradeRequestPost', compact('yourItem', 'theyGiveItem', 'offers', 'numOffers', 'countIncoming'));
    }

    public function requests()
    {

        $user_id = auth()->user()->id;

        $theyWantItemId =  \App\Trade::where('user_id_tradee', $user_id)->pluck('post_id_tradee');
        $theyWantItem = Post::whereIn('id', $theyWantItemId)->paginate(20);

        $tradeStatusOffer = DB::select(DB::raw('SELECT * FROM trades WHERE user_id_tradee = :user_id'), array('user_id' => $user_id));
        foreach ($tradeStatusOffer as $offer)
        {

        }

        $countIncoming = \App\Trade::where('user_id_tradee', $user_id)->count();

        return view('profiles.tradeRequests', compact('theyWantItem', 'offer', 'countIncoming'));

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

        return redirect()->route('trade.myTradeIndex', auth()->user()->id);
    }

}
