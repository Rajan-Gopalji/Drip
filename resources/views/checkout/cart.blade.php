@extends('layouts.app')

<head>
    {{--        <link href="{{ asset('css/main_styles.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/cart.css')}}" rel="stylesheet">
    {{--        <link rel="stylesheet" type="text/css" href="{{ asset('css/cart_responsive.css')}}styles/cart_responsive.css">--}}
{{--    <script>--}}
{{--        function myFunction() {--}}
{{--            var delivery = document.getElementById("nextDay").checked;--}}
{{--            if (delivery === true){--}}
{{--                {{$total = $total + 4}}--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
</head>

@section('content')
    <!-- Cart Info -->
    <div class="cart_info">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Column Titles -->
                    <div class="cart_info_columns clearfix">
                        <div class="cart_info_col cart_info_col_product">Product</div>
                        <div class="cart_info_col cart_info_col_price">Price</div>
                        <!-- <div class="cart_info_col cart_info_col_quantity">Quantity</div> -->
                        <div class="cart_info_col cart_info_col_quantity">-</div>
                        <!-- <div class="cart_info_col cart_info_col_total">Total</div> -->
                        <div class="cart_info_col cart_info_col_total">-</div>
                    </div>
                </div>
            </div>
            <div class="row cart_items_row">
                <div class="col">
                    @if($total == 0)
                        <p>
                            No Items in Cart
                        </p>
                        @else
                @foreach($posts as $post)
                    <!-- Cart Item -->
                    <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                        <!-- Name -->
                        <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
                            <a href="/p/{{$post->id}}">
                                <div class="cart_item_image">
                                    <div><img src="/storage/{{$post->image}}" alt="#"></div>
                                </div>
                            </a>
                            <div class="cart_item_name_container">

{{--                                {{dd($post->caption)}}--}}

                                <div class="cart_item_name"><a href="/p/{{$post->id}}">{{$post->caption}}</a></div>
                                <div class="cart_item_edit"><a href="#">Edit Product</a></div>
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="cart_item_price">£{{$post->price}}</div>
                        <!-- Quantity -->
                        <div class="cart_item_quantity">
                            <div class="product_quantity_container">
                                <div class="clearfix">
                                  <div class="button clear_cart_button">
                                      <a href="{{ route('cart.destroy', ['post_id' => $post->id]) }}" onclick="return confirm('Are you sure?')" class="block-delete">Remove</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total -->
                    <!-- <div class="cart_item_total">£</div> -->
                    </div>
                    @endforeach
                        @endif
                </div>
            </div>
            <div class="row row_cart_buttons">
                <div class="col">
                    <div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
                        <div class="button continue_shopping_button"><a href="/">Continue shopping</a></div>
                        <div class="cart_buttons_right ml-lg-auto">
                            <div class="button clear_cart_button"><a href="{{ route('cart.clear', ['user_id' => Auth::user()->id]) }}">Clear cart</a></div>
                            <div class="button update_cart_button"><a href="/profile/{{Auth::user()->id}}/cart">Update cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row_extra">
                <div class="col-lg-4">

                    <!-- Delivery -->
                    <div class="delivery">
                        <div class="section_title">Shipping Charge</div>
{{--                        <div class="section_subtitle">Select your delivery option</div>--}}
                        <div class="delivery_options">
{{--                            <label class="delivery_option clearfix">Next day delivery--}}
{{--                                <input type="radio" name="radio" id="nextDay" value="4.99">--}}
{{--                                <span class="checkmark"></span>--}}
{{--                                <span class="delivery_price">£4.99</span>--}}
{{--                            </label>--}}
{{--                            <label class="delivery_option clearfix">Standard delivery--}}
{{--                                <input type="radio" name="radio" id="free" value="0.00">--}}
{{--                                <span class="checkmark"></span>--}}
{{--                                <span class="delivery_price">Free</span>--}}
{{--                            </label>--}}
                            <p>
                                Orders over <b id="price">£100</b> are given <b id="price">FREE next day delivery</b>
                                <br>
                                <br>
                                @if($total < 100)
                                    Your order value comes to £{{$total}} so delivery is £4.99 for standard delivery
                                    @else
                                    Your order value comes to £{{$total}} so delivery is FREE!
                                @endif
                            </p>
                        </div>
                    </div>
                    <!-- Coupon Code -->
{{--                    <div class="coupon">--}}
{{--                        <div class="section_title">Coupon code</div>--}}
{{--                        <div class="section_subtitle">Enter your coupon code</div>--}}
{{--                        <div class="coupon_form_container">--}}
{{--                            <form action="#" id="coupon_form" class="coupon_form">--}}
{{--                                <input type="text" class="coupon_input" required="required">--}}
{{--                                <button class="button coupon_button"><span>Apply</span></button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <!--Cart total -->
                <div class="col-lg-6 offset-lg-2">
                    <div class="cart_total">
                        <div class="section_title">Cart total</div>
                        <div class="section_subtitle">Final info</div>
                        <div class="cart_total_container">
                            <ul>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">Subtotal</div>
                                    <div class="cart_total_value ml-auto">£{{$total}}</div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">Shipping</div>
                                    @if($total < 100)
                                        <div class="cart_total_value ml-auto">£4.99</div>
                                    @else
                                        <div class="cart_total_value ml-auto">Free</div>
                                    @endif
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">Total</div>
                                    <div class="cart_total_value ml-auto">£{{$totalShipping}}</div>
                                </li>
                            </ul>
                        </div>
                        <div class="button checkout_button"><a href="/{{Auth::user()->id}}/cart/checkout">Proceed to checkout</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <script src="{{ asset('js/delivery.js') }}" defer></script>--}}
@endsection
