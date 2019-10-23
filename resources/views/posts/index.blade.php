@extends('layouts.app')

@section('content')
    <div class="container">
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
                    </div>
            @endforeach

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
