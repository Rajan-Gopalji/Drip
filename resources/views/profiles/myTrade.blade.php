@extends('layouts.app')
<link href="{{ asset('css/toggle.css')}}" rel="stylesheet">
@section('content')
    <div class="container">
        <h1>My Trades</h1>
        <div class="row">
            <div class="switch switch--horizontal float-right pt-3">
                <input id="radio-a" type="radio" name="first-switch" checked="checked"/>
                <label for="radio-a">My Trades</label>
                <input id="radio-b" type="radio" onclick="window.location='/{{Auth::user()->id}}/myTrades/requests'" name="first-switch"/>
                <label for="radio-b">Trade Requests</label><span class="toggle-outside"><span class="toggle-inside"></span></span>
            </div>
        </div>

{{--        <a href="/{{Auth::user()->id}}/myTrades" class="toggleButton">My Trades</a>--}}
{{--        <a href="/{{Auth::user()->id}}/myTrades/requests" class="toggleButton">Requests</a>--}}

{{--        <label class="switch">--}}
{{--            <input type="checkbox" onclick="window.location='/{{Auth::user()->id}}/myTrades/requests'">--}}
{{--            <span class="slider round"></span>--}}
{{--        </label>--}}


{{--        <input type="checkbox" class="toggleButton" onclick="window.location='/{{Auth::user()->id}}/myTrades/requests'"/>Requests--}}
        @if($countOutgoing == 0)
            <h3 class="pt-5">You have not initiated any trades</h3>
        @else
            <div class="pt-3">
                <h4 class="pt-5">Click item to view offers</h4>
                <div class="row pt-2">
                    @foreach($theyWillGiveItem as $theyGive)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <a href="/{{Auth::user()->id}}/myTrades/{{ $theyGive->id }}">
                                {{--                                    @foreach ($imageSelect as $mimage)--}}
                                <img src="/storage/{{$theyGive->image}}" class="w-100">
                                {{--                            @endforeach--}}
                                <div class="pt-2">
                                            <span class="text-light pl-2">
                                                <b>{{ $theyGive->caption }}</b>
                                            </span>
                                    <span class="text-success float-right pr-2">
                                                £{{ $theyGive->price }}
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

