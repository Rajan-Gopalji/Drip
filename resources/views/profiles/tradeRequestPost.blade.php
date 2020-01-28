@extends('layouts.app')
<link href="{{ asset('css/toggle.css')}}" rel="stylesheet">
<link href="{{ asset('css/sold.css')}}" rel="stylesheet">
@section('content')
    <div class="container">
        <h1>Trade Requests</h1>
        <div class="row">
            <div class="switch switch--horizontal float-right pt-3">
                <input id="radio-a" type="radio" name="first-switch" onclick="window.location='/{{Auth::user()->id}}/myTrades'"/>
                <label for="radio-a">My Trades</label>
                <input id="radio-b" type="radio" name="first-switch" checked="checked"/>
                <label for="radio-b">Trade Requests</label><span class="toggle-outside"><span class="toggle-inside"></span></span>
            </div>
        </div>
        <h2 class="pt-5">Item to Trade</h2>
        <div class="row pt-2 pb-5">
            @foreach($yourItem as $yourItem)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    {{--            <a href="/{{Auth::user()->id}}/myTrades/requests/{{ $itemTheyGive->id }}">--}}
                    {{--                                    @foreach ($imageSelect as $mimage)--}}
                    <img src="/storage/{{$yourItem->image}}" class="w-100">
                    {{--                            @endforeach--}}
                    <div class="pt-2">
                                    <span class="text-light pl-2">
                                        <b>{{ $yourItem->caption }}</b>
                                    </span>
                        <span class="text-success float-right pr-2">
                                        £{{ $yourItem->price }}
                                    </span>
                    </div>
                    {{--                    </a>--}}
                </div>
            @endforeach

                @if($offers->contains("y"))
                    <div class="button"><a href="#">Accepted</a></div>
{{--                    <div class="button"><a href="{{ route('trade.cancel', ['post_id' => $yourItem->id]) }}">Clear Trade</a></div>--}}
                @elseif($offers->contains("n"))
                    <div class="button"><a href="#">Declined</a></div>
                @endif
        </div>



        <h2>({{$numOffers}}) Offers</h2>
        <div class="row pt-2">
            @foreach($theyGiveItem as $itemTheyGive)
{{--                @if($offers->contains("p"))--}}
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="/p/{{ $itemTheyGive->id }}">
                    {{--                                    @foreach ($imageSelect as $mimage)--}}
                    <img src="/storage/{{$itemTheyGive->image}}" class="w-100">
                    {{--                            @endforeach--}}
                    <div class="pt-2">
                                <span class="text-light pl-2">
                                    <b>{{ $itemTheyGive->caption }}</b>
                                </span>
                        <span class="text-success float-right pr-2">
                                    £{{ $itemTheyGive->price }}
                                </span>
                    </div>
                    </a>
{{--                @endif--}}
            <div class="offer pt-3">
                @if($offers->contains("y"))
                    @if($accept_id == $itemTheyGive->id)
                        <div class="button"><a href="#">Accepted</a></div>
                    @endif
                @elseif($offers->contains("n"))
                    <div class="button"><a href="{{ route('trade.accept', ['post_id_trader' => $itemTheyGive->id, 'post_id_tradee' => $yourItem->id]) }}">Accept</a></div>
                @else
                    <div class="button"><a href="{{ route('trade.accept', ['post_id_trader' => $itemTheyGive->id, 'post_id_tradee' => $yourItem->id]) }}">Accept</a></div>
                    <div class="button"><a href="{{ route('trade.decline', ['post_id' => $itemTheyGive->id]) }}">Decline</a></div>
                @endif
            </div>
            </div>

            @endforeach
        </div>
        <br>
    </div>
@endsection
