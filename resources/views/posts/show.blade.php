@extends('layouts.app')
<head>
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/product_responsive.css') }}">
{{--    <link href="{{ asset('css/main_styles.css') }}" rel="stylesheet">--}}
</head>
@section('content')
<div class="container">
    <div class="row">
        <!-- Other images -->
        <div class="col-2">
            <div class="details_image_thumbnail" data-image="/storage/{{$post->image}}"><img src="/storage/{{$post->image}}" alt=""></div>
        @foreach($mImage as $image)
            <div class="details_image">
                <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                    <div class="details_image_thumbnail" data-image="/storage/uploads/{{$image}}">
{{--                        <img src="{{ URL::to('/') }}/images/{{$image }}" alt="">--}}
                        <img src="/storage/uploads/{{$image}}" alt="">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="details_image_large col-5">
{{--            {{dd($mImage->image)}}--}}
            <img src="/storage/{{$post->image}}" class="w-100">
{{--            <img src="{{ URL::to('/') }}/images/{{$mImage->first() }}" class="w-100">--}}
        </div>
        <div class="col-lg-5">
            <div class="d-flex align-items-center">
                <div class="pr-3 pb-4">
                    <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                </div>
                <div>
                    <div class="font-weight-bold pb-4">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                        {{--                            <a href="#" class="pl-3">Follow</a>--}}
                    </div>
                </div>
            </div>
            <div class="details_content">
                <div class="details_name">{{ $post->caption }}</div>
                <!-- <div class="details_discount">$890</div> -->
                <div class="details_price">£{{ $post->price }}</div>

                <!-- In Stock -->
                <!-- <div class="in_stock_container">
                    <div class="availability">Availability:</div>
                    <span>In Stock</span>
                </div> -->
                <!-- Size -->
                <div class="details_text">
                    <div class="details_size">Size: <span>{{ ucfirst(trans($post->size)) }}</span></div>
                </div>
                <!-- Colour -->
                <div class="details_text">
                    <p>Colour: {{ ucfirst(trans($post->colour)) }}</p>
                </div>
                <!-- Condition -->
                <div class="details_text">
                    <p>Condition: {{ ucfirst(trans($post->quality)) }}</p>
                </div>
                <!-- Product Quantity -->
                <div class="product_quantity_container">
                    <!-- <div class="product_quantity clearfix">
                        <span>Qty</span>
                        <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                        <div class="quantity_buttons">
                            <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                            <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                        </div>
                    </div> -->
                <!-- <div class="button cart_button"><a href="#">Remove from cart</a></div> -->
{{--                    <input class="button cart_button" type="submit" name="removeCart" value="Remove from cart"/>--}}
                </div>
                @if($duplicate == true)
                    <div class="button cart_button"><a href="/cart/add/{{$post->id}}">Remove from Cart</a></div>
                @else
                    <div class="button cart_button"><a href="/cart/add/{{$post->id}}">Add to cart</a></div>
                @endif
                <!-- Share -->
                <!-- <div class="details_share">
                    <span>Share:</span>
                    <ul>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    </ul>
                </div> -->
            </div>
        </div>
        <div class="row description_row">
            <div class="col">
                <div class="description_title_container">
                    <div class="description_title">Description</div>
                    <!-- <div class="reviews_title"><a href="#">Reviews <span>(1)</span></a></div> -->
                </div>
                <div class="description_text">
                    <p>{{ $post->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
