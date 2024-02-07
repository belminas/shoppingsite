@extends('layouts.app')
@section('content')
<div class="container mx-auto py-5">
  <div class="col-10">
    <div class="row pb-5">
      <div class="col-6 offset-3">
            <a href="/products/{{ optional($randomPost)->id }}">
            <img src="/storage/{{ optional($randomPost)->image }}" alt="" class="pb-3 rounded-image zoom-in-effect pb-5">
            <span class="fw-bold text-dark fw-bold pt-5">{{ optional($randomPost)->description }}</span>
          </a>
      </div>
    </div>
  </div> 
</div>

<div class="container mx-auto">
  <div class="row pt-5">

    @foreach ($prebuildSale as $post)

    <div class="col-3">
      <div>
        <a href="/products/{{$post->id}}">
          <img src="/storage/{{$post->image}}" alt="" class="w-100 rounded-image zoom-in-effect pb-5">
          <span class="fw-bold text-dark fw-bold pt-5">{{$post->title}}</span>
          <span class="fw-bold text-danger fw-bold">{{$post->price}} $</span>
        </a>
      </div>
    </div>

    @endforeach

  </div>

  <div class="row pt-5">

    @foreach ($notebookSale as $post)

    <div class="col-3">
      <div>
        <a href="/products/{{$post->id}}">
          <img src="/storage/{{$post->image}}" alt="" class="w-100 rounded-image zoom-in-effect pb-5">
          <span class="fw-bold text-dark fw-bold pt-5">{{$post->title}}</span>
          <span class="fw-bold text-danger fw-bold">{{$post->price}} $</span>
        </a>
      </div>
    </div>

    @endforeach

  </div>

  <div class="row pt-5">

    @foreach ($monitorSale as $post)

    <div class="col-3">
      <div>
        <a href="/products/{{$post->id}}">
          <img src="/storage/{{$post->image}}" alt="" class="w-100 rounded-image zoom-in-effect pb-5">
          <span class="fw-bold text-dark fw-bold">{{$post->title}}</span>
          <span class="fw-bold text-danger fw-bold">{{$post->price}} $</span>
        </a>
      </div>
    </div>

    @endforeach

  </div>
</div>

@endsection
