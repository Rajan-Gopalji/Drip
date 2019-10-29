@extends('layouts.app')
<head>
    <link href="{{ asset('css/checkout.css')}}" rel="stylesheet">
{{--    <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>--}}
{{--    <script>paypal.Buttons().render('body');</script>--}}
</head>
@section('content')
    <body>
    <div class="checkout">
        <div class="container">
            <div class="row">

                <!-- Billing Info -->
                <div class="col-lg-6">
                    <div class="billing checkout_section">
                        <div class="section_title">Billing Address</div>
                        <div class="section_subtitle">Enter your address info</div>
                        <div class="checkout_form_container">
                            <form action="#" id="checkout_form" class="checkout_form">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <!-- Name -->
                                        <label for="checkout_name">First Name*</label>
                                        <input type="text" id="checkout_name" class="checkout_input" required="required">
                                    </div>
                                    <div class="col-xl-6 last_name_col">
                                        <!-- Last Name -->
                                        <label for="checkout_last_name">Last Name*</label>
                                        <input type="text" id="checkout_last_name" class="checkout_input" required="required">
                                    </div>
                                </div>
                                <div>
                                    <!-- Country -->
                                    <label for="checkout_country">Country*</label>
                                    <select name="checkout_country" id="checkout_country" class="dropdown_item_select checkout_input" require="required">
                                        <option></option>
                                        <option>Lithuania</option>
                                        <option>Sweden</option>
                                        <option>UK</option>
                                        <option>Italy</option>
                                    </select>
                                </div>
                                <div>
                                    <!-- Address -->
                                    <label for="checkout_address">Address*</label>
                                    <input type="text" id="checkout_address" class="checkout_input" required="required">
                                    <input type="text" id="checkout_address_2" class="checkout_input checkout_address_2" required="required">
                                </div>
                                <div>
                                    <!-- Zipcode -->
                                    <label for="checkout_zipcode">Post-Code*</label>
                                    <input type="text" id="checkout_zipcode" class="checkout_input" required="required">
                                </div>
                                <div>
                                    <!-- City / Town -->
                                    <label for="checkout_city">City/Town*</label>
                                    <select name="checkout_city" id="checkout_city" class="dropdown_item_select checkout_input" require="required">
                                        <option></option>
                                        <option>City</option>
                                        <option>City</option>
                                        <option>City</option>
                                        <option>City</option>
                                    </select>
                                </div>
                                <div>
                                    <!-- Phone no -->
                                    <label for="checkout_phone">Phone no*</label>
                                    <input type="phone" id="checkout_phone" class="checkout_input" required="required">
                                </div>
                                <div>
                                    <!-- Email -->
                                    <label for="checkout_email">Email Address*</label>
                                    <input type="phone" id="checkout_email" class="checkout_input" required="required">
                                </div>
                                <div class="checkout_extra">
                                    <div>
                                        <input type="checkbox" id="checkbox_terms" name="regular_checkbox" class="regular_checkbox" checked="checked">
                                        <label for="checkbox_terms"><img src="images/check.png" alt=""></label>
                                        <span class="checkbox_title">Terms and conditions</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Info -->

                <div class="col-lg-6">
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
                                <label class="payment_option clearfix">Paypal
                                    <input type="radio" name="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="payment_option clearfix">Credit card
                                    <input type="radio" name="radio">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="button order_button"><a href="#">Place Order</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
