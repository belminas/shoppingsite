@extends('layouts.app')

@section('content')

<div class="container">
    <form action="/products" enctype="multipart/form-data" method="post">
        @csrf
    <div class="row">
    <div class="col-8 offser-2">
        <div class="row">
            <h1> Add New Post</h1>
        </div>
        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label">Post Title</label>

                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"  autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="price" class="col-md-4 col-form-label">Post price</label>

                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="description" class="col-md-4 col-form-label">Post description</label>

                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"  autocomplete="description" autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="tags" class="col-md-4 col-form-label">Post tags</label>

                                <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ old('tags') }}"  autocomplete="tags" autofocus>

                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="amount" class="col-md-4 col-form-label">Post amount</label>

                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}"  autocomplete="amount" autofocus>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
            </div>
            <div class="row">
                <label for="image" class="col-md-4 col-form-label">Post Image</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" id="image">
                @error('image')
                    <strong>{{ $message }}</strong>
                 @enderror
            </div>
            <div class="row pt-4">
                <button class="btn btn-primary"  style="max-width:20%;">Add new Post</button>
            </div>
   </div>
    </form>
</div>

@endsection