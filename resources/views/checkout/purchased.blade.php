@extends('layouts.app')
<link href="{{ asset('css/checkout.css')}}" rel="stylesheet">

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="order checkout_section">
                <div class="section_title">Thank you for your purchase!</div>
                <div class="section_subtitle">Your order will never arrive because this is a test site. We didn't take your money either.</div>

                <div class="button order_button"><a href="{{url('/')}}">Home</a></div>

            </div>
        </div>
    </div>
@endsection


