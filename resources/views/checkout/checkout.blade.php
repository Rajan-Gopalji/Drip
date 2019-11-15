@extends('layouts.app')
<head>
{{--    <script src="https://js.stripe.com/v3/"></script>--}}
    <link href="{{ asset('css/checkout.css')}}" rel="stylesheet">
{{--    <link href="{{ asset('css/payment.css')}}" rel="stylesheet">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    {{--    <script src="https://www.paypal.com/sdk/js?client-id=Aavww4kFYbaI3XUK2WvHvbb8kSqaL9ifMnBCwseTSOGlm_m8xVcxeBCiIk-QRxPB-jGkWQbhCWG84uu3"></script>--}}
    <!-- Include the PayPal JavaScript SDK -->
{{--    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=GBP"></script>--}}
    <script src="https://www.paypal.com/sdk/js?client-id=Aavww4kFYbaI3XUK2WvHvbb8kSqaL9ifMnBCwseTSOGlm_m8xVcxeBCiIk-QRxPB-jGkWQbhCWG84uu3&currency=GBP"></script>
</head>

@section('content')
    <body>
    <div class="checkout">
        <div class="container">
            <div class="row">

{{--                <!-- Billing Info -->--}}
{{--                <div class="col-lg-6">--}}
{{--                    <div class="billing checkout_section">--}}
{{--                        <div class="section_title">Billing Address</div>--}}
{{--                        <div class="section_subtitle">Enter your address info</div>--}}
{{--                        <div class="checkout_form_container">--}}
{{--                            <form action="#" id="checkout_form" class="checkout_form">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-xl-6">--}}
{{--                                        <!-- Name -->--}}
{{--                                        <label for="checkout_name">First Name*</label>--}}
{{--                                        <input type="text" id="checkout_name" class="checkout_input" required="required">--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-6 last_name_col">--}}
{{--                                        <!-- Last Name -->--}}
{{--                                        <label for="checkout_last_name">Last Name*</label>--}}
{{--                                        <input type="text" id="checkout_last_name" class="checkout_input" required="required">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <!-- Country -->--}}
{{--                                    <label for="checkout_country">Country*</label>--}}
{{--                                    <select name="checkout_country" id="checkout_country" class="dropdown_item_select checkout_input" require="required">--}}
{{--                                        <option></option>--}}
{{--                                        <option>United States</option>--}}
{{--                                        <option>Sweden</option>--}}
{{--                                        <option>UK</option>--}}
{{--                                        <option>Italy</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <!-- Address -->--}}
{{--                                    <label for="checkout_address">Address*</label>--}}
{{--                                    <input type="text" id="checkout_address" class="checkout_input" required="required">--}}
{{--                                    <input type="text" id="checkout_address_2" class="checkout_input checkout_address_2" required="required">--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <!-- Zipcode -->--}}
{{--                                    <label for="checkout_zipcode">Post-Code*</label>--}}
{{--                                    <input type="text" id="checkout_zipcode" class="checkout_input" required="required">--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <!-- City / Town -->--}}
{{--                                    <label for="checkout_city">City/Town*</label>--}}
{{--                                    <select name="checkout_city" id="checkout_city" class="dropdown_item_select checkout_input" require="required">--}}
{{--                                        <option></option>--}}
{{--                                        <option>City</option>--}}
{{--                                        <option>City</option>--}}
{{--                                        <option>City</option>--}}
{{--                                        <option>City</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <!-- Phone no -->--}}
{{--                                    <label for="checkout_phone">Phone no*</label>--}}
{{--                                    <input type="phone" id="checkout_phone" class="checkout_input" required="required">--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <!-- Email -->--}}
{{--                                    <label for="checkout_email">Email Address*</label>--}}
{{--                                    <input type="phone" id="checkout_email" class="checkout_input" required="required">--}}
{{--                                </div>--}}
{{--                                <div class="checkout_extra">--}}
{{--                                    <div>--}}
{{--                                        <input type="checkbox" id="checkbox_terms" name="regular_checkbox" class="regular_checkbox" checked="checked">--}}
{{--                                        <label for="checkbox_terms"><img src="images/check.png" alt=""></label>--}}
{{--                                        <span class="checkbox_title">Terms and conditions</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <!-- Order Info -->

                <div class="col-lg-12">
                    <div class="order checkout_section">
                        <div class="section_title">Your order</div>
                        <div class="section_subtitle">Order details</div>

                        <!-- Order details -->
                        <div class="order_list_container">
                            <div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
{{--                                <div class="order_list_title"><u>Product</u></div>--}}
{{--                                <div class="order_list_value ml-auto"><u>Total</u></div>--}}
                            </div>
                            <ul class="order_list">
{{--                                <li class="d-flex flex-row align-items-center justify-content-start">--}}
{{--                                    <div class="order_list_title">Nike Hoodie</div>--}}
{{--                                    <div class="order_list_value ml-auto">£</div>--}}
{{--                                </li>--}}
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
{{--                                <label class="payment_option clearfix">Paypal--}}
{{--                                    <input type="radio" name="radio">--}}
{{--                                    <span class="checkmark"></span>--}}
{{--                                </label>--}}
{{--                                <label class="payment_option clearfix">Credit card--}}
{{--                                    <input type="radio" name="radio">--}}
{{--                                    <span class="checkmark"></span>--}}
{{--                                </label>--}}
                            </div>
                        </div>
{{--                        <div id="paypal_button"></div>--}}
{{--                        <div id="charge-error" class="alert alert-danger {{ !session()->has('error') ? 'hidden' : ''  }}">--}}
{{--                            {{ session()->get('error') }}--}}
{{--                        </div>--}}
{{--                        <form action="{{ route('checkout.postCheckout') }}" method="post" id="checkout-form">--}}
{{--                        <div class="col-xs-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="card-name">Card Holder Name</label>--}}
{{--                                <input type="text" id="card-name" class="form-control" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xs-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="card-number">Credit Card Number</label>--}}
{{--                                <input type="text" id="card-number" class="form-control" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xs-12">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-xs-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="card-expiry-month">Expiration Month</label>--}}
{{--                                        <input type="text" id="card-expiry-month" class="form-control" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xs-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="card-expiry-year">Expiration Year</label>--}}
{{--                                        <input type="text" id="card-expiry-year" class="form-control" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xs-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="card-cvc">CVC</label>--}}
{{--                                <input type="text" id="card-cvc" class="form-control" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                            @csrf--}}
                        <div class="pl-5" id="paypal-button-container"></div>
                        <div class="button order_button" id="paypal-button-container2"><a href="{{ route('checkout.purchased', ['user_id' => Auth::user()->id]) }}">Finalise Payment</a></div>
                    {{--                            <button type="submit" class="btn btn-success">Buy now</button>--}}
                    {{--                        </form>--}}
                        <!-- Set up a container element for the button -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection



{{--<script>paypal.Buttons().render('#paypal-button-container2');</script>--}}
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

{{--<script>--}}
{{--    var amount = {{$totalShipping}}--}}
{{--    paypal.Buttons({--}}

{{--        env: 'sandbox', // sandbox | production--}}
{{--        client: {--}}
{{--            sandbox:    'Aavww4kFYbaI3XUK2WvHvbb8kSqaL9ifMnBCwseTSOGlm_m8xVcxeBCiIk-QRxPB-jGkWQbhCWG84uu3',--}}
{{--            production: 'xxxxxxxxxx'--}}
{{--        },--}}

{{--        // Show the buyer a 'Pay Now' button in the checkout flow--}}
{{--        commit: true,--}}

{{--        // payment() is called when the button is clicked--}}
{{--        payment: function(data, actions) {--}}
{{--            // Make a call to the REST API to set up the payment--}}
{{--            return actions.payment.create({--}}
{{--                payment: {--}}
{{--                    transactions: [--}}
{{--                        {--}}
{{--                            amount: { total: '0.01', currency: 'USD' }--}}
{{--                        }--}}
{{--                    ],--}}
{{--                    redirect_urls: {--}}
{{--                        return_url: 'http://localhost:8000/purchased',--}}
{{--                        cancel_url: 'http://localhost:8000/'--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        },--}}

{{--        // onAuthorize() is called when the buyer approves the payment--}}
{{--        onAuthorize: function(data, actions) {--}}

{{--            // Make a call to the REST API to execute the payment--}}
{{--            return actions.payment.execute().then(function() {--}}
{{--                    actions.redirect('return_url');--}}
{{--                    // location.replace("http://localhost:8000/purchased")--}}
{{--                }--}}
{{--            );--}}
{{--        },--}}

{{--        onCancel: function(data, actions) {--}}
{{--            actions.redirect('http://localhost:8000/');--}}
{{--        }--}}


{{--    }).render('#paypal-button-container2');--}}
{{--</script>--}}


{{--@section('scripts')--}}
{{--    <script src="https://js.stripe.com/v3/"></script>--}}
{{--    <script src="{{ asset('js/checkout.js') }}"></script>--}}
{{--@endsection--}}


{{--    <script>paypal.Buttons().render('body');</script>--}}
{{--    <script>--}}
{{--        paypal.Buttons({--}}
{{--            createOrder: function(data, actions) {--}}
{{--                return actions.order.create({--}}
{{--                    purchase_units: [{--}}
{{--                        amount: {--}}
{{--                            value: '155.00'--}}
{{--                        }--}}
{{--                    }]--}}
{{--                });--}}
{{--            },--}}
{{--            onApprove: function(data, actions) {--}}
{{--                // Capture the funds from the transaction--}}
{{--                return actions.order.capture().then(function(details) {--}}
{{--                    // Show a success message to your buyer--}}
{{--                    // return actions.redirect('/');--}}
{{--                    document.getElementById("response").style.display = 'inline-block';--}}
{{--                    document.getElementById("response").innerHTML = 'Thank you for making the payment!';--}}
{{--                    // alert('Transaction completed by ' + details.payer.name.given_name);--}}
{{--                });--}}
{{--            }--}}
{{--        }).render('#paypal-button-container');--}}
{{--    </script>--}}

