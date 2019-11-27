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
                        <div class="button checkout_button"><a href="/p/{{$postTrade->id}}/trade/{{Auth::user()->id}}/myTrades">Make Trade</a></div>
                    </div>

        </div>

        <form action="/p/{{$postTrade->id}}/trade" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group row">
                <label for="post_id_trader" class="col-md-4 col-form-label">Item you'll trade</label>
                @foreach($item as $postTrader)
                <div class="radio-toolbar">
                    <input type="radio" id="radioPostid" name="post_id_trader" value="{{$postTrader->id}}">
                    <label for="{{$postTrader->id}}">{{$postTrader->caption}}</label>
                </div>
                @endforeach

                @if ($errors->has('post_id_trader'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('post_id_trader') }}</strong>
                        </span>
                @endif
            </div>

                <div class="form-group row">
                    <label for="gender" class="col-md-4 col-form-label">Item you want</label>

                    <div class="radio-toolbar">
                        <input type="radio" id="radioPosteeid" name="post_id_tradee" value="{{$postTrade->id}}" checked>
                        <label for="{{$postTrade->id}}">{{$postTrade->caption}}</label>
                    </div>

                    @if ($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    @endif
                </div>

            <div class="form-group row">
                <label for="gender" class="col-md-4 col-form-label">Tradee</label>

                <div class="radio-toolbar">
                    <input type="radio" id="user_id_tradee" name="user_id_tradee" value="{{$postTrade->user_id}}" checked>
{{--                    <label for="{{$postTrade->user_id}}"></label>--}}
                </div>

                @if ($errors->has('gender'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-group row">
                <label for="gender" class="col-md-4 col-form-label">Trader</label>

                <div class="radio-toolbar">
                    <input type="radio" id="user_id" name="user_id" value="{{$post->user_id}}" checked>
{{--                                        <label for="{{$post->user_id}}"></label>--}}
                </div>

                @if ($errors->has('gender'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                @endif
            </div>

                <div class="row pt-4">
                    <button type="submit" class="btn btn-primary">Ini Trade</button>
                </div>
        </form>
    </div>
@endsection


