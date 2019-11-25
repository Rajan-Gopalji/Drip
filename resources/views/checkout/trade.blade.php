@extends('layouts.app')
<link href="{{ asset('css/sold.css')}}" rel="stylesheet">
<link href="{{ asset('css/cart.css')}}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/trade.js') }}" defer></script>
@section('content')
    <div class="container">
        <h1>Trade</h1>
        <br>
        <h3>Choose item(s) to trade:</h3>
        <div id="trade">
            <div class="row">
                @foreach($item as $post)
                <div class="col-4 pb-4">
                    @if($post->sold == 'y')
                        <img id="greyout" src="/storage/{{$post->image}}" class="w-100">
                        <img id="soldprofile" src="https://www.sticker.com/picture_library/product_images/real-estate-stickers/74125_sold-small-rectangles-red-and-white-stickers-and-labels.png">
    {{--                    <img src="/storage/{{$post->image}}" alt="#" class="img-fluid">--}}
                        <div class="pt-2">
                                <span class="text-light pl-2">
                                    <b>{{ $post->caption }}</b>
                                </span>
                            <span class="text-success float-right pr-2">
                                    £{{ $post->price }}
                                </span>
                        </div>
                    @else
    {{--                    <div id="trade">--}}
                            <div class="custom-control custom-checkbox image-checkbox">
                                <input type="checkbox" class="custom-control-input" value="{{$post->price}}" id="{{$post->id}}">
                                <label class="custom-control-label" for="{{$post->id}}">
                                    <img src="/storage/{{$post->image}}" alt="#" class="img-fluid">
                                    <div class="pt-2">
                                <span class="text-light pl-2">
                                    <b>{{ $post->caption }}</b>
                                </span>
                                        <span class="text-success float-right pr-2">
                                    £{{ $post->price }}
                                </span>
                                    </div>
                                </label>
                            </div>
    {{--                    </div>--}}

                    @endif
                </div>
                @endforeach
            </div>
        </div>

            <h3>Item you want:</h3>
        <div class="row">
                @foreach($itemTrade as $postTrade)
                    <div class="col-4 pb-4">
                        <input type="checkbox" class="custom-control-input" id="{{$postTrade->id}}" checked>
                        <label class="custom-control-label" for="{{$postTrade->id}}">
                            <img src="/storage/{{$postTrade->image}}" alt="#" class="img-fluid">
                            <div class="pt-2">
                            <span class="text-light pl-2">
                                <b>{{ $postTrade->caption }}</b>
                            </span>
                                <span class="text-success float-right pr-2">
                                £{{ $postTrade->price }}
                            </span>
                            </div>
                        </label>
                    </div>
                @endforeach
                    <div class="col-lg-6 offset-lg-2">
                        <div class="cart_total_container">
                            <ul>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">Your valuation</div>
                                    <div class="cart_total_value ml-auto"><div id='sum'>£0</div></div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">

                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">Item valuation</div>
                                    <div class="cart_total_value ml-auto">£{{$postTrade->price}}</div>
                                </li>
                            </ul>
                        </div>
                    </div>

        </div>
    </div>
@endsection


