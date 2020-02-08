@extends('layouts.app')

<head>
    <link href="{{ asset('css/cart.css')}}" rel="stylesheet">
    <link href="{{ asset('css/sold.css')}}" rel="stylesheet">
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
                        <div class="cart_info_col cart_info_col_quantity">-</div>
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
                            @if($post->sold == 'y')
                                <div class="cart_item_image">
                                    <div><img id="greyout" src="/storage/{{$post->image}}" alt="#"></div>
                                    <img id="soldprofile" src="https://www.sticker.com/picture_library/product_images/real-estate-stickers/74125_sold-small-rectangles-red-and-white-stickers-and-labels.png">
                                </div>
                            @else
                            <a href="/p/{{$post->id}}">
                                <div class="cart_item_image">
                                    <div><img src="/storage/{{$post->image}}" alt="#"></div>
                                </div>
                            </a>
                            <div class="cart_item_name_container">
                                <div class="cart_item_name"><a href="/p/{{$post->id}}">{{$post->caption}}</a></div>
                                <div class="cart_item_edit"><a href="#">Edit Product</a></div>
                            </div>
                                @endif
                        </div>
                        <!-- Price -->
                        <div class="cart_item_price"><p id="pricey">£{{$post->price}}</p></div>
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
                        <div class="delivery_options">
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
                        @if($total != 0 and $post->sold == 'n')
                            <div class="button checkout_button"><a href="/{{Auth::user()->id}}/cart/checkout">Proceed to checkout</a></div>
                        @elseif($total > 0 and $post->sold == 'y')
                            <h3 class="float-right">Remove sold items from cart</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
