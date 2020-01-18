@extends('layouts.app')
<link href="{{ asset('css/sold.css')}}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{ $user->username }}</div>
                     @cannot('update', $user->profile)
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    @endcannot
                    @can('update', $user->profile)
                        <div class="pl-3">
                            <a href="/profile/{{ $user->id }}/edit">&#9881;     Edit Profile</a>
                        </div>
                    @endcan
                </div>

                @can('update', $user->profile)
                    <div class="button">
                        <a href="/p/create">Post New Item</a>
                    </div>
                @endcan

            </div>

            <div class="d-flex">
                <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                @if($post->sold == 'y')
                    <img id="greyout" src="/storage/{{$post->image}}" class="w-100">
                    <img id="soldprofile" src="https://www.sticker.com/picture_library/product_images/real-estate-stickers/74125_sold-small-rectangles-red-and-white-stickers-and-labels.png">
                    <div class="pt-2">
                                        <span class="text-light pl-2">
                                            <b>{{ $post->caption }}</b>
                                        </span>
                        <span class="text-success float-right pr-2">
                                    £{{ $post->price }}
                                </span>
                    </div>
                @else
                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->image }}" class="w-100">
                        <div class="pt-2">
                                            <span class="text-light pl-2">
                                                <b>{{ $post->caption }}</b>
                                            </span>
                            <span class="text-success float-right pr-2">
                                £{{ $post->price }}
                            </span>
                        </div>
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
