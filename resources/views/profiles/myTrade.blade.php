@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Trades</h1>
        @if($countOutgoing == 0 and $countIncoming == 0)
            <h3 class="pt-3">No active trades</h3>
        @endif

        @if($countOutgoing == 0)

        @else
            <div class="row pt-5">
                @foreach($posts as $post)
                    <h2>You'll give:</h2>
                    <div class="col-lg-4 col-md-6 col-sm-12">
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

                @foreach($itemTradee2 as $postee)
                        <h2>You'll Want:</h2>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="/p/{{ $postee->id }}">
                            {{--                            @foreach ($imageSelect as $mimage)--}}
                            <img src="/storage/{{$postee->image}}" class="w-100">
                            {{--                            @endforeach--}}
                            <div class="pt-2">
                                                <span class="text-light pl-2">
                                                    <b>{{ $postee->caption }}</b>
                                                </span>
                                <span class="text-success float-right pr-2">
                                            £{{ $postee->price }}
                                        </span>
                            </div>
                        </a>
                    </div>
                @endforeach
    {{--                <button type="submit" class="btn btn-primary">Ini Trade</button>--}}
                    <div class="row pt-3">
                        <div class="button"><a href="#">Pending</a></div>
                    </div>
            </div>
        @endif
<br>
        @if($countIncoming == 0)
{{--            No incoming trades--}}
        @else
            <div class="row pt-3">
                @foreach($otherEndPostFulltheyllgive as $otherEndPost)
                    <h2>They give:</h2>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="/p/{{ $otherEndPost->id }}">
                            {{--                            @foreach ($imageSelect as $mimage)--}}
                            <img src="/storage/{{$otherEndPost->image}}" class="w-100">
                            {{--                            @endforeach--}}
                            <div class="pt-2">
                                                <span class="text-light pl-2">
                                                    <b>{{ $otherEndPost->caption }}</b>
                                                </span>
                                <span class="text-success float-right pr-2">
                                            £{{ $otherEndPost->price }}
                                        </span>
                            </div>
                        </a>
                    </div>
                @endforeach

                @foreach($otherEndPostFulltheywant as $otherEndPost)
                    <h2>They want:</h2>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="/p/{{ $otherEndPost->id }}">
                            {{--                            @foreach ($imageSelect as $mimage)--}}
                            <img src="/storage/{{$otherEndPost->image}}" class="w-100">
                            {{--                            @endforeach--}}
                            <div class="pt-2">
                                                <span class="text-light pl-2">
                                                    <b>{{ $otherEndPost->caption }}</b>
                                                </span>
                                <span class="text-success float-right pr-2">
                                            £{{ $otherEndPost->price }}
                                        </span>
                            </div>
                        </a>
                    </div>
                @endforeach
                    <div class="row pt-3">
                        <div class="button"><a href="#">Accept</a></div>
                        <div class="button"><a href="#">Decline</a></div>
                    </div>
            </div>
        @endif
    </div>


@endsection
