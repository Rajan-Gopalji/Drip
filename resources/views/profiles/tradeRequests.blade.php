@extends('layouts.app')
<link href="{{ asset('css/toggle.css')}}" rel="stylesheet">
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
        {{--    Others requesting a trade    --}}
        @if($countIncoming == 0 or $offer->accepts == 'n')
            <h3 class="pt-5">No incoming trades</h3>
        @else
            <div class="pt-3">
{{--            @if($offer->accepts == 'n')--}}

{{--            @else--}}
                <h4 class="pt-5">Click item to view offers</h4>
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
