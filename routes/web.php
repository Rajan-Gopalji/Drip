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

Auth::routes();

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});

Route::post('follow/{user}', 'FollowsController@store');

Route::get('/', 'PostsController@index');
Route::get('/p/create', 'PostsController@create');
//Route::get('/ImageUpload/{last_id}', 'testcontroller@index');
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
//Route::post('/checkout', 'CheckoutController@postCheckout')->name('checkout.postCheckout');
//Route::post('/processed', 'CheckoutController@processed')->name('checkout.processed');



Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/manage', 'ProfilesController@manage')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');


//Route::get('multiple-file-upload', 'MultipleUploadController@index');

//Route::post('multiple-file-upload/upload', 'MultipleUploadController@upload')->name('upload');
Route::get('/ImageUpload', 'testcontroller@index');

Route::post('/ImageUpload/upload', 'testcontroller@upload')->name('ImageUpload');
