@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Trade Requests</h1>
        <a href="/{{Auth::user()->id}}/myTrades" class="btn">My Trades</a>
        <a href="/{{Auth::user()->id}}/myTrades/requests" class="btn">Requests</a>

        {{--    Others requesting a trade    --}}
        @if($countIncoming == 0 or $offer->accepts == 'n')
            <h3>No incoming trades</h3>
        @else
            <div class="pt-3 float-right">
            {{--                        @if($offer->accepts == 'n')--}}

{{--                        @else--}}
                {{-- Change var name as this person owns these items               --}}
                <h4>Click item to view offers</h4>
                <div class="row pt-2">
                @foreach($theyWantItem as $theyWant)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="/{{Auth::user()->id}}/myTrades/requests/{{ $theyWant->id }}">
                            <img src="/storage/{{$theyWant->image}}" class="w-100">
                            <div class="pt-2">
                                <span class="text-light pl-2">
                                    <b>{{ $theyWant->caption }}</b>
                                </span>
                                <span class="text-success float-right pr-2">
                                    £{{ $theyWant->price }}
                                </span>
                            </div>
                        </a>
                        </div>
                @endforeach
                </div>
            </div>
        @endif
    </div>


@endsection
