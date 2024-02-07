@extends('layouts.app')

@section('content')

@foreach($posts as $post)

<div class="container">
  <div class="row p-5">
    <div class="col-6 offset-3">
      <a href="/products/{{$post->id}}">
      <img src="/storage/{{$post->image}}" alt="" class="pb-3 rounded-image zoom-in-effect p-5">
      </a>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-7 d-flex flex-column justify-content-center align-items-center">
      <span class="fw-bold text-dark pt-5">{{$post->description}}</span>

      <div class="mt-3">
        <form class="ps-5" action="/delete/{{$post->id}}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endforeach

@endsection