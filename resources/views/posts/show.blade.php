@extends('layouts.app')
<head>
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/product_responsive.css') }}">
</head>
@section('content')
<div class="container">
    <div class="row">
        <!-- Other images -->
        <div class="col-lg-2 col-sm-12 pb-4">
            <div class="details_image_thumbnail" data-image="/storage/{{$post->image}}"><img src="/storage/{{$post->image}}" alt=""></div>
        @foreach($mImage as $image)
            <div class="details_image">
                <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                    <div class="details_image_thumbnail" data-image="/storage/uploads/{{$image}}">
                        <img src="/storage/uploads/{{$image}}" alt="">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="details_image_large col-lg-5 col-md-6 col-sm-12">
            <img src="/storage/{{$post->image}}" class="w-100">
        </div>
        <div class="col-lg-5 pt-1">
            <div class="d-flex align-items-center">
                <div class="pr-3 pb-4">
                    <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                </div>
                <div>
                    <div class="font-weight-bold pb-4">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-light">{{ $post->user->username }}</span>
                        </a>
                        {{--                            <a href="#" class="pl-3">Follow</a>--}}
                    </div>
                </div>
            </div>
            <n class="details_content">
                <div class="details_name">{{ $post->caption }}</div>
                <div class="details_price">£{{ $post->price }}</div>
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

                </div>
                @if($post->user->id != Auth::user()->id )
                    @if($trade_exists)
                        <div class="button cart_button"><a href="/cart/add/{{$post->id}}">Add to cart*</a></div>
                        <h5 class="pt-3">*You have this item in a trade. Adding to cart will cancel the trade.</h5>
                    @else
                        @if($post->sold == 'y')
                            <div class="button cart_button"><a href="#">Item has been SOLD!</a></div>
                        @elseif($duplicate == true)
                            <div class="button cart_button"><a href="/cart/add/{{$post->id}}">Remove from Cart</a></div>
                        @elseif($count > 0)
                            <div class="button cart_button"><a href="/cart/add/{{$post->id}}">Add to cart</a></div>
                            <div class="button cart_button"><a href="{{$post->id}}/trade">Trade</a></div>
                        @else
                            <div class="button cart_button"><a href="/cart/add/{{$post->id}}">Add to cart</a></div>
                        @endif
                    @endif
                @endif
        </div>
        <div class="row description_row">
            <div class="col">
                <div class="description_title_container">
                    <div class="description_title">Description</div>
                </div>
                <div class="description_text">
                    <p>{{ $post->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
