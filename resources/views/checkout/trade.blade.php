@extends('layouts.app')
<link href="{{ asset('css/sold.css')}}" rel="stylesheet">

@section('content')
    <div class="container">
        <h1>Trade</h1>
        <br>
        <h3>Choose an item to trade:</h3><h5>*Choosing an item that has been used in another trade will cancel that trade and open this one</h5>
        <form action="/p/{{$postId}}/trade" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group row pt-2">
                @foreach($item as $postTrader)
                    @if($postTrader->sold == 'y')

                    @else
                    <div class="col-4 pb-4">
                    <div class="radio-toolbar">
                        <div class="custom-control custom-checkbox image-checkbox">
                            <input type="checkbox" class="custom-control-input" id="{{$postTrader->id}}" name="post_id_trader" value="{{$postTrader->id}}">
                            <label class="custom-control-label" for="{{$postTrader->id}}">
                                <img src="/storage/{{$postTrader->image}}" alt="#" class="img-fluid">
                                <div class="pt-2">
                                <span class="text-light pl-2">
                                    <b>{{ $postTrader->caption }}</b>
                                </span>
                                    <span class="text-success float-right pr-2">
                                    £{{ $postTrader->price }}
                                </span>
                                </div>
                            </label>
                        </div>
                    </div>
                    </div>
                    @endif
                @endforeach
                @if ($errors->has('post_id_trader'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('post_id_trader') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group row">
            <h3>Item you want:</h3>

                <div class="radio-toolbar">
                    @foreach($itemTrade as $postTrade)
                        <div class="col-4 pb-4">
                                <img src="/storage/{{$postTrade->image}}" alt="#" class="img-fluid">
                                <div class="pt-2">
                            <span class="text-light pl-2">
                                <b>{{ $postTrade->caption }}</b>
                            </span>
                                    <span class="text-success float-right pr-2">
                                £{{ $postTrade->price }}
                            </span>
                                </div>
                            </label>
                        </div>
                    @endforeach

                </div>

                @if ($errors->has('gender'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                @endif
            </div>

            <div class="row pb-5 pl-3">
                <button type="submit" class="btn btn-primary">Make Trade</button>
            </div>
        </form>
    </div>
@endsection

