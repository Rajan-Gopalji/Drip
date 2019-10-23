@extends('layouts.app')

@section('content')
    <head>
        <link href="{{ asset('css/button.css') }}" rel="stylesheet" />
    </head>
<div class="container">
    <form action="/profile/{{$user->id}}/p/{{$post->id}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Add New Post</h1>
                </div>
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Item Name</label>

                    <input id="caption"
                           type="text"
                           class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}"
                           name="caption"
                           value="{{ old('caption') ?? $post->caption}}"
                           autocomplete="caption" autofocus>

                    @if ($errors->has('caption'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('caption') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="size" class="col-md-4 col-form-label">Size</label>

                    <div class="radio-toolbar">
                        @if($post->size == 'small')
                            <input type="radio" id="radioSmall" name="size" value="small" checked>
                            <label for="radioSmall">S</label>
                            <input type="radio" id="radioMedium" name="size" value="medium">
                            <label for="radioMedium">M</label>
                            <input type="radio" id="radioLarge" name="size" value="large">
                            <label for="radioLarge">L</label>
                        @elseif($post->size == 'medium')
                            <input type="radio" id="radioSmall" name="size" value="small">
                            <label for="radioSmall">S</label>
                            <input type="radio" id="radioMedium" name="size" value="medium" checked>
                            <label for="radioMedium">M</label>
                            <input type="radio" id="radioLarge" name="size" value="large">
                            <label for="radioLarge">L</label>
                        @else
                            <input type="radio" id="radioSmall" name="size" value="small">
                            <label for="radioSmall">S</label>
                            <input type="radio" id="radioMedium" name="size" value="medium">
                            <label for="radioMedium">M</label>
                            <input type="radio" id="radioLarge" name="size" value="large" checked>
                            <label for="radioLarge">L</label>
                        @endif
                    </div>

                    @if ($errors->has('size'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('size') }}</strong>
                        </span>
                    @endif
                </div>

                <br>

                <div class="form-group row">
                    <label for="gender" class="col-md-4 col-form-label">Gender</label>

                    <div class="radio-toolbar">
                        @if ($post->gender == 'men')
                            <input type="radio" id="radioMen" name="gender" value="men" checked>
                            <label for="radioMen">Men</label>
                            <input type="radio" id="radioWomen" name="gender" value="women">
                            <label for="radioWomen">Women</label>
                        @else
                            <input type="radio" id="radioMen" name="gender" value="men">
                            <label for="radioMen">Men</label>
                            <input type="radio" id="radioWomen" name="gender" value="women" checked>
                            <label for="radioWomen">Women</label>
                        @endif
                    </div>
                    <p>&nbsp;</p>

                    @if ($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    @endif
                </div>

                <br>

                <div class="form-group row">
                    <label for="quality" class="col-md-4 col-form-label">Condition</label>

                    <div class="radio-toolbar">
                        @if($post->quality == 'new')
                            <input type="radio" id="radioNew" name="quality" value="new" checked>
                            <label for="radioNew">New</label>
                            <input type="radio" id="radioUsed" name="quality" value="used">
                            <label for="radioUsed">Used</label>
                        @else
                            <input type="radio" id="radioNew" name="quality" value="new">
                            <label for="radioNew">New</label>
                            <input type="radio" id="radioUsed" name="quality" value="used" checked>
                            <label for="radioUsed">Used</label>
                        @endif
                    </div>

                    @if ($errors->has('quality'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('quality') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="price" class="col-md-4 col-form-label">Price</label>

                    <input type="text" name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                           id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?$"
                           value="{{ old('price') ?? $post->price}}" data-type="currency" placeholder="£0000.00" maxlength = "4" required><i>Items must be <£10,000</i>
                    {{--                    <script type="text/javascript" src="{{ asset('js/currency.js') }}" ></script>--}}


                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label">Category</label>

                    <input id="category"
                           type="text"
                           class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}"
                           name="category"
                           value="{{ old('category') ?? $post->category}}"
                           autocomplete="category" autofocus>

                    @if ($errors->has('category'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="colour" class="col-md-4 col-form-label">Colour</label>

                    <div class="radio-toolbar">
                        <input type="radio" id="radioBlack" name="colour" value="black">
                        <label for="radioBlack">Black</label>

                        <input type="radio" id="radioWhite" name="colour" value="white">
                        <label for="radioWhite">White</label>

                        <input type="radio" id="radioGrey" name="colour" value="grey">
                        <label for="radioGrey">Grey</label>

                        <input type="radio" id="radioBlue" name="colour" value="blue">
                        <label for="radioBlue">Blue</label>

                        <input type="radio" id="radioRed" name="colour" value="red">
                        <label for="radioRed">Red</label>

                        <input type="radio" id="radioStone" name="colour" value="stone">
                        <label for="radioStone">Stone</label>
                    </div>

                    @if ($errors->has('colour'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('colour') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Description</label>

                    <input id="description"
                           type="text"
                           class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                           name="description"
                           value="{{ old('description') ?? $post->description}}"
                           autocomplete="description" autofocus>

                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Post Image</label>

                    <input type="file" class="form-control-file" id="image" name="image">

                    @if ($errors->has('image'))
                        <strong>{{ $errors->first('image') }}</strong>
                    @endif
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Update Item Post</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection