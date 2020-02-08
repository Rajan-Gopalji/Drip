@extends('layouts.app')

@section('content')
    <head>
        <link href="{{ asset('css/button.css') }}" rel="stylesheet" />
    </head>
<div class="container">
    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="/p/{{ $post->id }}">
                    <div class="text-right">
                        <a href="{{ route('post.destroy', ['id' => $post->id, 'user' => $user ->id]) }}" onclick="return confirm('Are you sure?')" class="block-delete">Delete</a>
                    </div>
                    <img src="/storage/{{ $post->image }}" class="w-100">
                    <div>
                        <div class="text-left">
                            <a href="/profile/{{Auth::user()->id}}/p/{{$post->id}}/edit" class="block">Update</a>
                        </div>
                    </div>
                    <div class="pt-2">
                                        <span class="text-light pl-2">
                                            <b>{{ $post->caption }}</b>
                                        </span>
                        <span class="text-success float-right pr-2">
                            £{{ $post->price }}
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

