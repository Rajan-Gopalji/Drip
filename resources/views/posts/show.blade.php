@extends('layouts.app')

@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/product.css') }}">
        <link rel="stylesheet" href="{{ asset('css/product_responsive.css') }}">
        <link href="{{ asset('css/main_styles.css') }}" rel="stylesheet">
    </head>
<div class="container">
    <div class="row">
        <!-- Other images -->
        <div class="col-2">
            <div class="details_image_thumbnail" data-image=""><img src="/storage/{{$post->image}}" alt=""></div>
        @foreach($mImage as $image)
            <div class="details_image">
                <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                    <div class="details_image_thumbnail" data-image=""><img src="{{ URL::to('/') }}/images/{{$image }}" alt=""></div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-5">
{{--            {{dd($mImage->image)}}--}}
            <img src="/storage/{{$post->image}}" class="w-100">
{{--            <img src="{{ URL::to('/') }}/images/{{$mImage->first() }}" class="w-100">--}}
        </div>
        <div class="col-5">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                    </div>
                    <div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
{{--                            <a href="#" class="pl-3">Follow</a>--}}
                        </div>
                    </div>
                </div>

                <hr>

                <p>
                    <span class="font-weight-bold">
                            <span class="text-light">{{ $post->caption }}</span>
                    </span>
                </p>
                <p>
                    <span class="font-weight-bold">
                            <span class="text-dark">For:  </span>
                    </span>  {{ $post->gender }}
                </p>
                <p>
                    <span class="font-weight-bold">
                            <span class="text-dark">Category: </span>
                    </span>  {{ $post->category }}
                </p>
                <p>
                    <span class="font-weight-bold">
                            <span class="text-dark">Size: </span>
                    </span> {{ $post->size }}
                </p>
                <p>
                    <span class="font-weight-bold">
                            <span class="text-dark">Price: </span>
                    </span> {{ $post->price }}
                </p>
                <p>
                    <span class="font-weight-bold">
                            <span class="text-dark">Condition: </span>
                    </span> {{ $post->quality }}
                </p>
                <p>
                    <span class="font-weight-bold">
                            <span class="text-dark">Description: </span>
                    </span> {{ $post->description }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
