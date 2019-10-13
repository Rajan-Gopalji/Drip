<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
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

        return redirect('/profile/' . auth()->user()->id);
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
            $imagePath = request('image')->store('profile', 'public');

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

    public function delete(User $user, $id)
    {
        $post = Post::where('id', $id);
        $post->delete();
        return redirect("/profile/{$user->id}")->with('success', 'Post Deleted');
    }

    public function show(\App\Post $post)
    {
        return view('posts.show', compact('post'));
    }

}
