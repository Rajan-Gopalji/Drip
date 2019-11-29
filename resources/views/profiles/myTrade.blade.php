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
                <h2>You give:</h2>
                @foreach($posts as $post)
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
                        <h2>You Want:</h2>
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
                        @if($yourOffer->accepts == 'n')
                            <div class="button"><a href="{{ route('trade.renegotiate', ['post' => $postee]) }}">Renegotiate</a></div>
                            <div class="button"><a href="{{ route('trade.cancel', ['post_id' => $postee->id]) }}">Cancel Trade</a></div>
                        @elseif($yourOffer->accepts == 'y')
                            <div class="button"><a href="#">Accepted</a></div>
                        @else
                        <div class="button"><a href="#">Pending</a></div>
                        @endif
{{--                        <div class="button"><a href="{{ route('trade.cancel', ['post_id' => $postee->id]) }}">Cancel Trade</a></div>--}}
                    </div>
            </div>
        @endif
        <br>
        <br>
        @if($countIncoming == 0 or $offer->accepts == 'n')
            {{--            No incoming trades--}}
        @else
            <h2>Trade Requests:</h2>
            <div class="row pt-4">
                @foreach($otherEndPostFulltheyllgive as $otherEndPostTradee)
{{--                    @if($offer->accepts == 'n')--}}

{{--                    @else--}}
                        <h2>You give:</h2>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <a href="/p/{{ $otherEndPostTradee->id }}">
                                {{--                            @foreach ($imageSelect as $mimage)--}}
                                <img src="/storage/{{$otherEndPostTradee->image}}" class="w-100">
                                {{--                            @endforeach--}}
                                <div class="pt-2">
                                                    <span class="text-light pl-2">
                                                        <b>{{ $otherEndPostTradee->caption }}</b>
                                                    </span>
                                    <span class="text-success float-right pr-2">
                                                £{{ $otherEndPostTradee->price }}
                                            </span>
                                </div>
                            </a>
                        </div>
{{--                    @endif--}}
                @endforeach


{{--                        @if($offer->accepts == 'n')--}}

{{--                        @else--}}
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
                            @if($offer->accepts == 'y')
                                <div class="button"><a href="#">Accepted</a></div>
                            @else
                                <div class="button"><a href="{{ route('trade.accept', ['post_id_trader' => $otherEndPost->id, 'post_id_tradee' => $otherEndPostTradee->id]) }}">Accept</a></div>
                                <div class="button"><a href="{{ route('trade.decline', ['post_id' => $otherEndPost->id]) }}">Decline</a></div>
                            @endif
                        </div>
{{--                        @endif--}}

            </div>
        @endif
    </div>


@endsection
