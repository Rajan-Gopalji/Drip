@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Trades</h1>
    <a href="/{{Auth::user()->id}}/myTrades" class="btn">My Trades</a>
    <a href="/{{Auth::user()->id}}/myTrades/requests" class="btn">Requests</a>
    <h2>Item to Trade</h2>
    <div class="row pt-2 pb-5">
        @foreach($itemYouWant as $youWant)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="/p/{{ $youWant->id }}">
                <img src="/storage/{{$youWant->image}}" class="w-100">
                <div class="pt-2">
                    <span class="text-light pl-2">
                        <b>{{ $youWant->caption }}</b>
                    </span>
                    <span class="text-success float-right pr-2">
                        £{{ $youWant->price }}
                    </span>
                </div>
                </a>
            </div>

        @endforeach
            @if($offer == "n")
                <div class="button"><a href="{{ route('trade.renegotiate', ['post' => $youWant->id]) }}">Renegotiate</a></div>
                <div class="button"><a href="{{ route('trade.cancel', ['post_id' => $youWant->id]) }}">Cancel Trade</a></div>
            @elseif($offer == "y")
                <div class="button"><a href="#">Accepted</a></div>
                <div class="button"><a href="#">Clear Trade</a></div>
            @else
                <div class="button"><a href="#">Pending</a></div>
                <div class="button"><a href="{{ route('trade.cancel', ['post_id' => $youWant->id]) }}">Cancel Trade</a></div>
            @endif
    </div>

    <h2>Your Offer</h2>
    <div class="row pt-2">
        @foreach($youGiveItem as $youGive)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="/p/{{ $youGive->id }}">
                    {{--                                    @foreach ($imageSelect as $mimage)--}}
                    <img src="/storage/{{$youGive->image}}" class="w-100">
                    {{--                            @endforeach--}}
                    <div class="pt-2">
                                    <span class="text-light pl-2">
                                        <b>{{ $youGive->caption }}</b>
                                    </span>
                        <span class="text-success float-right pr-2">
                                        £{{ $youGive->price }}
                                    </span>
                    </div>
                </a>
            </div>

        @endforeach
    </div>
    <br>
</div>
@endsection

