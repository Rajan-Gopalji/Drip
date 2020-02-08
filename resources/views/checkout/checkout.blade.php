@extends('layouts.app')
<head>
    <link href="{{ asset('css/checkout.css')}}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=Aavww4kFYbaI3XUK2WvHvbb8kSqaL9ifMnBCwseTSOGlm_m8xVcxeBCiIk-QRxPB-jGkWQbhCWG84uu3&currency=GBP"></script>
</head>

@section('content')
    <body>
    <div class="checkout">
        <div class="container">
            <div class="row">
                <!-- Order Info -->
                <div class="col-lg-12">
                    <div class="order checkout_section">
                        <div class="section_title">Your order</div>
                        <div class="section_subtitle">Order details</div>

                        <!-- Order details -->
                        <div class="order_list_container">
                            <div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
                            </div>
                            <ul class="order_list">
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="order_list_title">Subtotal</div>
                                    <div class="order_list_value ml-auto">£{{$total}}</div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="order_list_title">Shipping</div>
                                    @if($total < 100)
                                        <div class="order_list_value ml-auto">£4.99</div>
                                        @else
                                        <div class="order_list_value ml-auto">Free</div>
                                    @endif
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="order_list_title">Total</div>
                                    <div class="order_list_value ml-auto">£{{$totalShipping}}</div>
                                </li>
                            </ul>
                        </div>

                        <!-- Payment Options -->
                        <div class="payment">
                            <div class="payment_options">
                            </div>
                        </div>
                        <div class="pl-5" id="paypal-button-container"></div>
                        <div class="button order_button" id="paypal-button-container2"><a href="{{ route('checkout.purchased', ['user_id' => Auth::user()->id]) }}">Finalise Payment</a></div>
                        <!-- Set up a container element for the button -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection



<script>
    // Render the PayPal button into #paypal-button-container
var amount = {{$totalShipping}}
    console.log(amount);
    paypal.Buttons({

        // Set up the transaction
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: amount
                    }
                }]
            });
        },

        // Finalize the transaction
        onApprove: function(data, actions) {
{{--            {{route('cart.clear')}}--}}
            return actions.order.capture().then(function(details) {
                // Show a success message to the buyer
                alert('Transaction completed by ' + details.payer.name.given_name + '!');

            });
        }


    }).render('#paypal-button-container');
</script>

