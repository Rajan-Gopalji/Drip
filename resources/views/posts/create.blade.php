@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Add New Post</h1>
                </div>
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Post Caption</label>

                    <input id="caption"
                           type="text"
                           class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}"
                           name="caption"
                           value="{{ old('caption') }}"
                           autocomplete="caption" autofocus>

                    @if ($errors->has('caption'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('caption') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="gender" class="col-md-4 col-form-label">Gender</label>

                    <input id="gender"
                           type="text"
                           class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}"
                           name="gender"
                           value="{{ old('gender') }}"
                           autocomplete="gender" autofocus>

                    @if ($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label">Category</label>

                    <input id="category"
                           type="text"
                           class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}"
                           name="category"
                           value="{{ old('category') }}"
                           autocomplete="category" autofocus>

                    @if ($errors->has('category'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category') }}</strong>
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
                    <button class="btn btn-primary">Add New Post</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
