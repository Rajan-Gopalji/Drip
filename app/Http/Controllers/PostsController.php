<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Multi_image;
use App\Post;
use App\Profile;
use App\User;
use App\Trade;
//use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
//use App\Http\Controllers\NumberFormatter;
use function Sodium\compare;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::filter($request)->whereIn('user_id', $users)->with('user')->latest()->paginate(99);
        $postId = auth()->user()->posts()->pluck('posts.id');
        $mImage = Multi_image::all();

        $userId = auth()->user()->id;
        $followers = DB::table('profile_user')->where('user_id', $userId)->exists();

        $otherUsers = Profile::where('id', '!=', $userId)->get();

        return view('posts.index', compact('posts','mImage', 'imageSelect', 'followers', 'otherUsers'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request, Post $post, User $user)
    {
        $data = request()->validate([
            'caption' => 'required',
            'gender' => 'required',
            'category' => 'required',
            'size' => 'required',
            'quality' => 'required',
            'description' => 'required',
            'colour' => 'required',
            'price' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        $fmt = numfmt_create( 'en_GB', \NumberFormatter::CURRENCY );
        $price = numfmt_format_currency($fmt, $data['price'], "GBP")."\n";
        $price_new = str_replace('£','',$price);
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'gender' => $data['gender'],
            'category' => $data['category'],
            'size' => $data['size'],
            'quality' => $data['quality'],
            'description' => $data['description'],
            'colour' => $data['colour'],
            'price' => $price_new,
            'sold' => 'n',
            'image' => $imagePath,
        ]);

        $last_id = DB::getPDO()->lastInsertId();
//        dd($last_id);
        if($request->hasFile('images'))
        {
            $image_array = $request->file('images');

            $array_len = count($image_array);
            for($i=0; $i<$array_len; $i++)
            {
                $image_ext = $image_array[$i]->getClientOriginalExtension();

                $new_image_name = rand().".".$image_ext;
                $destination_path = public_path('storage/uploads');
//                $destination_path = request('image')->store('uploads', 'public');

                $image_array[$i]->move($destination_path, $new_image_name);

                $multi_image = new multi_image;
                $multi_image->post_id = $last_id;
                $multi_image->image = $new_image_name;
                $multi_image->save();
            }

        }
        return redirect('/profile/' . auth()->user()->id);
    }

    public function destroy(User $user, $id)
    {
        Post::destroy($id);
        return back()->with('success', 'Post Updated');
    }


    public function edit(User $user, Post $post)
    {
        $this->authorize('update', $user->profile);

//        dd($post->id);
        return view('posts.edit', compact('user', 'post'));
    }

    public function update(Request $request, User $user, Post $post)
    {
        $data = request()->validate([
            'caption' => '',
            'gender' => '',
            'category' => '',
            'size' => '',
            'quality' => '',
            'description' => '',
            'colour' => '',
            'price' => '',
            'image' => '',
        ]);

        $last_id = $post->id;
        if($request->hasFile('images'))
        {
            $image_array = $request->file('images');

            $array_len = count($image_array);
            for($i=0; $i<$array_len; $i++)
            {
                $image_ext = $image_array[$i]->getClientOriginalExtension();

                $new_image_name = rand().".".$image_ext;
                $destination_path = public_path('storage/uploads');

                $image_array[$i]->move($destination_path, $new_image_name);

                $multi_image = new multi_image;
                $multi_image->post_id = $last_id;
                $multi_image->image = $new_image_name;
                $multi_image->save();
            }

        }

        if (request('image')) {
            $imagePath = request('image')->store('uploads', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        $post->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        return redirect("/profile/{$user->id}")->with('success', 'Post Updated');

    }

    public function show(\App\Post $post)
    {
        $postId = $post->id;
        $mImage = DB::table('multi_image')->where('post_id', $postId)->pluck('image');
        $postsIm = Post::whereIn('id', $mImage)->paginate(5);
        $user_id = auth()->user()->id;
        $count = Post::where('user_id', $user_id)->count();
        $trade_exists = Trade::where(['user_id' => $user_id, 'post_id_tradee' => $postId])->exists();
        $duplicate = Cart::where(['user_id' => $user_id, 'post_id' => $postId])->exists();
        return view('posts.show', compact('post', 'mImage', 'duplicate', 'trade_exists', 'count'));
    }

}
