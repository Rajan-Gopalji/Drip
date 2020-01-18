@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Trades</h1>
        <a href="/{{Auth::user()->id}}/myTrades" class="btn">My Trades</a>
        <a href="/{{Auth::user()->id}}/myTrades/requests" class="btn">Requests</a>
        @if($countOutgoing == 0)
            <h3>You have not initiated any trades</h3>
        @else
            {{-- Change var name as this person owns these items               --}}
            <h4>Click item to view offers</h4>
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
        @endif
    </div>

@endsection
