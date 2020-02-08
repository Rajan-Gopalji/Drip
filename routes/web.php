<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Input;
use App\Post;


Auth::routes();

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});

Route::any('/search',function(){
    $search = Input::get ( 'search' );
    $post = Post::where('caption','LIKE','%'.$search.'%')->get();
    if(count($post) > 0)
        return view('posts/search')->withDetails($post)->withQuery ($search);
    else return view ('posts/search')->withQuery ($search);
});

Route::post('follow/{user}', 'FollowsController@store');

Route::get('/', 'PostsController@index')->name('posts.index');
Route::post('/', 'PostsController@index')->name('posts.index');
Route::get('/', 'PostsController@index')->name('products');
Route::get('/p/create', 'PostsController@create');
Route::post('/p', 'PostsController@store');
Route::get('/men', 'CategoryController@men')->name('posts.men');
Route::get('/women', 'CategoryController@women');
Route::get('/p/{post}', 'PostsController@show');
Route::get('/profile/{user}/p/{post}/edit', 'PostsController@edit');
Route::patch('/profile/{user}/p/{post}', 'PostsController@update');
Route::get('/profile/{user}/destroy/{id}', 'PostsController@destroy')->name('post.destroy');

Route::get('/profile/{user}/cart', 'CartController@index')->name('cart.index');
Route::get('/cart/destroy/{post_id}', 'CartController@destroy')->name('cart.destroy');
Route::get('/cart/clear/{user_id}', 'CartController@clear')->name('cart.clear');
Route::get( '/cart/add/{post_id}', 'CartController@add' )->name('cart.add');

Route::get('/{user}/cart/checkout', 'CheckoutController@index')->name('checkout.index');
Route::get('{user}/purchased', 'CheckoutController@purchased')->name('checkout.purchased');

Route::get('/p/{post}/trade', 'TradeController@index')->name('trade.index');
Route::get('/p/{post}/renegotiate', 'TradeController@renegotiate')->name('trade.renegotiate');

Route::get('/{user}/myTrades', 'TradeController@myTradeIndex')->name('trade.myTradeIndex');
Route::get('/{user}/myTrades/requests', 'TradeController@requests')->name('trade.requests');

Route::get('/{user}/myTrades/{post}', 'TradeController@myTradeIndexPosts')->name('trade.myTradeIndexPosts');
Route::get('/{user}/myTrades/requests/{post}', 'TradeController@ItemRequests')->name('trade.ItemRequests');

Route::get('/myTrades/{post_id}/cancel', 'TradeController@cancel')->name('trade.cancel');
Route::get('/myTrades/{post_id_trader}/{post_id_tradee}/accept', 'TradeController@acceptTrade')->name('trade.accept');
Route::get('/myTrades/{post_id}/decline', 'TradeController@declineTrade')->name('trade.decline');

Route::post('/p/{post}/trade', 'TradeController@store')->name('trade.store');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/manage', 'ProfilesController@manage')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

