<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Multi_image;
use App\Post;
use App\User;
//use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use function Sodium\compare;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        $postId = auth()->user()->posts()->pluck('posts.id');

//        dd($postId);

//        $mImage = DB::table('multi_image')->where('post_id', $postId)->pluck('multi_image.post_id');
//        $mImage = Multi_image::whereIn('post_id', $postId)->with('post')->paginate(999);
        $mImage = Multi_image::all();
//        $mImage = DB::select('SELECT image FROM multi_image');


//        $imageSelect = DB::select('SELECT image FROM multi_image WHERE post_id = 4 LIMIT 1');

        $posst = 4;
        $imageSelect = DB::table('multi_image')
            ->where('post_id', $posst)->first();

//        dd($imageSelect->image);

//        foreach ($imageSelect as $mimage){
//            dd($mimage->image);
//        }

//        dd($mImage[2]->post_id);
//        foreach ($mImage as $mimage){
//        dd($mimage->image);
//        }
//        $mImage = Post::with('multi_image')->get();

        return view('posts.index', compact('posts','mImage', 'imageSelect'));
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

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'gender' => $data['gender'],
            'category' => $data['category'],
            'size' => $data['size'],
            'quality' => $data['quality'],
            'description' => $data['description'],
            'colour' => $data['colour'],
            'price' => $data['price'],
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
                $destination_path = public_path('/images');

                $image_array[$i]->move($destination_path, $new_image_name);

                $multi_image = new multi_image;
                $multi_image->post_id = $last_id;
                $multi_image->image = $new_image_name;
                $multi_image->save();
            }

//            return redirect()->back()->with('msg', 'all done');
        }
        return redirect('/profile/' . auth()->user()->id);
    }

    public function destroy(User $user, $id)
//    public function destroy(User $user, Post $post)
    {
//        $post = Post::where('id', $id);
//        $post->delete();
//        return redirect(back());
        Post::destroy($id);
//        dd($post);
//        return redirect("/profile/{$user->id}/manage")->with('success', 'Post Updated');
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
//        $this->authorize('update', $user->profile);
//        $post = Post::findOrFail($id);
//        dd($post);
        $data = request()->validate([
            'caption' => 'required',
            'gender' => 'required',
            'category' => 'required',
            'size' => 'required',
            'quality' => 'required',
            'description' => 'required',
            'colour' => 'required',
            'price' => 'required',
            'image' => '',
        ]);


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
//        dd($postId);
//        $mImage = auth()->user()->posts()->pluck('multi_image.post_id');
        $mImage = DB::table('multi_image')->where('post_id', $postId)->pluck('image');
//        dd($mImage);
        $postsIm = Post::whereIn('id', $mImage)->paginate(5);
//        dd($postsIm);
//        $mImage = Post::with('multi_image')->get();
        $user_id = auth()->user()->id;
        $duplicate = Cart::where(['user_id' => $user_id, 'post_id' => $postId])->exists();
        return view('posts.show', compact('post', 'mImage', 'duplicate'));
    }

}
