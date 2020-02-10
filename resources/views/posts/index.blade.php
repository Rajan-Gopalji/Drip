@extends('layouts.app')
<link href="{{ asset('css/sold.css')}}" rel="stylesheet">
<link href="{{ asset('css/filter.css')}}" rel="stylesheet">
<script src="{{ asset('js/filter.js') }}" defer></script>
{{--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">--}}

@section('content')
    <div>
        <div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-dark-grey" style="display:none" id="mySidebar">
            <button class="w3-bar-item w3-button w3-large text-right"
                    onclick="w3_close()">Close &times;</button>

            <h4 class="pl-1">Type of clothing</h4>
            <div class="pl-3">
                <button class="w3-button"><a href="?category=sports">Sports</a></button><br>
                <button class="w3-button"><a href="?category=casual">Casual</a></button><br>
                <button class="w3-button"><a href="?category=smart">Smart</a></button><br>
            </div>
            <br>
            <h4 class="pl-1">Size</h4>
            <div class="pl-3">
                <button class="w3-button"><a href="?size=small">Small</a></button><br>
                <button class="w3-button"><a href="?size=medium">Medium</a></button><br>
                <button class="w3-button"><a href="?size=large">Large</a></button><br>
            </div>
            <br>
            <h4 class="pl-">Colour</h4>
            <div class="pl-3">
                <button class="w3-button"><a href="?colour=black">Black</a></button><br>
                <button class="w3-button"><a href="?colour=grey">Grey</a></button><br>
                <button class="w3-button"><a href="?colour=red">Red</a></button><br>
                <button class="w3-button"><a href="?colour=blue">Blue</a></button><br>
                <button class="w3-button"><a href="?colour=white">White</a></button><br>
            </div>
            <br>
            <h4 class="pl-">Condition</h4>
            <div class="pl-3">
                <button class="w3-button"><a href="?quality=new">New</a></button><br>
                <button class="w3-button"><a href="?quality=used">Used</a></button><br>
            </div>
            <br>
            <div class="btn pb-5">
                <input type="button" onclick="window.location =  '/'" value="Clear All"/>
            </div>
            <div class="pb-5">
                <br>
                <br>
                <br>
            </div>
        </div>
        <button id="openNav" class="w3-button w3-medium" onclick="w3_open()">&#9776; Filter</button>
    </div>
    <div id="main">
        <div class="container">
            <div>
                <h1 id="page_title">Home</h1>
            </div>

{{--    No followers     --}}
            @if($followers == false)
            <div>
                <h2 class="pt-5">You're currently not following anyone!</h2>
                <h3 class="pt-5">Here's some recommendations to get you started</h3>
                <div class="row">
                    @foreach($otherUsers as $others)
                        <div class="col-lg-4 col-md-6 col-sm-12 pt-5">
                            <a href="/profile/{{ $others->user->id }}">
                                <img src="{{ $others->user->profile->profileImage() }}" class="rounded-circle w-500" style="max-width: 200px;">
                                <span class="text-light pl-2">{{ $others->user->username }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="row pt-3">
                @foreach($posts as $post)
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
                                    <img src="/storage/{{$post->image}}" class="w-100">
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

                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
