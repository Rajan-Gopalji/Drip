@extends('layouts.app')
<link href="{{ asset('css/sold.css')}}" rel="stylesheet">

@section('content')
    <div class="container">
        <div class="row pt-5">
            @foreach($posts as $post)
                @if($post->gender == 'women')
                    {{--                    <div class="row">--}}
                    <div class="col-lg-4 col-md-6 col-sm-12 pt-5">
                        <div class="pb-1">
                                <span class="font-weight-bold">
                                    <a href="/profile/{{ $post->user->id }}">
                                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                                        <span class="text-dark">{{ $post->user->username }}</span>
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
    {{--                            @foreach($mImage as $image)--}}
                                    <img src="/storage/{{ public_path($post->image) }}" class="w-100">
    {{--                            @endforeach--}}
                                <div class="pt-2">
                                            <span class="text-dark pl-2">
                                                <b>{{ $post->caption }}</b>
                                            </span>
                                    <span class="text-success float-right pr-2">
                                                £{{ $post->price }}
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
