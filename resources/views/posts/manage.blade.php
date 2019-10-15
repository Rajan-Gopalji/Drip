@extends('layouts.app')

@section('content')
    <head>
        <link href="{{ asset('css/button.css') }}" rel="stylesheet" />
{{--        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>--}}
{{--        <script src="sweetalert2.all.min.js"></script>--}}
{{--        <link rel="stylesheet" href="sweetalert2.min.css">--}}
{{--        <script src="{{ asset('js/popup.js') }}"></script>--}}
    </head>
<div class="container">
    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}">
                    <div class="text-right">
{{--                        <button type="button" class="block-delete">Delete</button>--}}
{{--                        <a class="block-delete" onClick="JSconfirm({{$post->id}})" name="Delete">Delete</a>--}}
                        <a href="{{ route('post.destroy', ['id' => $post->id, 'user' => $user ->id]) }}" onclick="return confirm('Are you sure?')" class="block-delete">Delete</a>
                    </div>
                    <img src="/storage/{{ $post->image }}" class="w-100">
                    <div>
                        <div class="text-left pl-2">
                            <a href="/profile/{{Auth::user()->id}}/p/{{$post->id}}/edit" class="block">Update</a>
                        </div>
                    </div>
                    <div class="pt-2">
                                        <span class="text-dark pl-2">
                                            <b>{{ $post->caption }}</b>
                                        </span>
                        <span class="text-success float-right pr-2">
                            £{{ $post->price }}
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

