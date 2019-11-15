@extends('layouts.app')
{{--<link href="{{ asset('css/filter.css')}}" rel="stylesheet">--}}
<link href="{{ asset('css/sold.css')}}" rel="stylesheet">
<script src="{{ asset('js/filter.js') }}" defer></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


@section('content')
    <div>
{{--        <span style="font-size:15px;cursor:pointer" onclick="openNav()">&#9776; Filter</span>--}}
        <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
            <button class="w3-bar-item w3-button w3-large"
                    onclick="w3_close()">Close &times;</button>


            <h4 class="pl-1">Type of clothing</h4>
            <div class="pl-3">
                <input type="checkbox" name="filter" value="jumper"> Jumpers<br>
                <input type="checkbox" name="filter" value="hoodie"> Hoodies<br>
                <input type="checkbox" name="filter" value="jogger"> Joggers<br>
                <input type="checkbox" name="filter" value="jean"> Jeans<br>
            </div>

            <br>

            <h4 class="pl-1">Size</h4>
            <div class="pl-3">
                <input class="filterbox" type="checkbox" name="filter" value="small"> Small<br>
                <input class="filterbox" type="checkbox" name="filter" value="medium"> Medium<br>
                <input class="filterbox" type="checkbox" name="filter" value="large"> Large<br>
            </div>

            <br>

            <h4 class="pl-1">Condition</h4>
            <div class="pl-3">
                <input type="checkbox" name="filter" value="new"> New<br>
                <input type="checkbox" name="filter" value="used"> Used<br>
            </div>
            <br>
            <div class="float-right pr-5">
                <input type="button" onclick='printChecked()' value="Confirm"/>
            </div>
        </div>
        <button id="openNav" class="w3-button w3-small" onclick="w3_open()">&#9776; Filter</button>
    </div>
    <div id="main">
    <div class="container">
        <div>
            <h1 id="page_title">Home</h1>
            <script>

            </script>
{{--            <span style="font-size:15px;cursor:pointer" onclick="openNav()">&#9776; Filter</span>--}}
        </div>
        <div class="row pt-5">
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
    {{--                            @foreach ($imageSelect as $mimage)--}}
                                <img src="/storage/{{$post->image}}" class="w-100">
    {{--                            @endforeach--}}
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
