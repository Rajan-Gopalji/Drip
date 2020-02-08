@extends('layouts.app')
<link href="{{ asset('css/sold.css')}}" rel="stylesheet">
<link href="{{ asset('css/filter.css')}}" rel="stylesheet">
<script src="{{ asset('js/filter.js') }}" defer></script>
@section('content')
    <div>
        <div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-dark-grey" style="display:none" id="mySidebar">
            <button class="w3-bar-item w3-button w3-large text-right"
                    onclick="w3_close()">Close &times;</button>

            <h4 class="pl-1">Type of clothing</h4>
            <div class="pl-3">
                <button><a href="?category=sports">Sports</a></button><br>
                <button><a href="?category=lifestyle">Lifestyle</a></button><br>
                <button><a href="?category=sports">???</a></button><br>
            </div>
            <br>
            <h4 class="pl-1">Size</h4>
            <div class="pl-3">
                <button><a href="?size=small">Small</a></button><br>
                <button><a href="?size=medium">Medium</a></button><br>
                <button><a href="?size=large">Large</a></button><br>
            </div>
            <br>
            <h4 class="pl-">Condition</h4>
            <div class="pl-3">
                <button><a href="?quality=new">New</a></button><br>
                <button><a href="?quality=used">Used</a></button><br>
            </div>
            <br>
            <div class="btn">
                <input type="button" onclick="window.location =  '/men'" value="Clear All"/>
            </div>
        </div>
        <button id="openNav" class="w3-button w3-medium" onclick="w3_open()">&#9776; Filter</button>
    </div>
<div id="main">
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
</div>
@endsection
