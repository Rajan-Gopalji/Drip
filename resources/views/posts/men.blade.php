@extends('layouts.app')
<link href="{{ asset('css/sold.css')}}" rel="stylesheet">

@section('content')
    <div class="container">
        <div>
            <h1 id="page_title">Men</h1>
        </div>
        <div class="row pt-5">
            @foreach($posts as $post)
{{--                {{dd($posts)}}--}}
                @if($post->gender == 'men')
{{--                    <div class="row">--}}
                        <div class="col-lg-4 col-md-6 col-sm-12 pt-5">
                            <div class="pb-1">
                                <span class="font-weight-bold">
                                    <a href="/profile/{{ $post->user->id }}">
                                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                                        <span class="text-light">{{ $post->user->username }}</span>
                                    </a>
                                </span>
                            </div>

                            @if($post->sold == 'y')
                                <img id="greyout" src="/storage/{{$post->image}}" class="w-100">
                                <img id="sold" src="https://www.sticker.com/picture_library/product_images/real-estate-stickers/74125_sold-small-rectangles-red-and-white-stickers-and-labels.png">
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
                                                £{{$post->price}}
                                            </span>
                                        </div>
                                </a>
                            @endif
                        </div>

                @endif
            @endforeach

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
