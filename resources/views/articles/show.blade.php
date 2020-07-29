@extends('layout')

@section('content')
<div id="wrapper">
  <div id="page" class="container">
    <div id="content">
      <div class="title">
        <h2>{{ $article->title }}</h2>
        <span class="byline">{{ $article->created_at }}</span>
      </div>
      <p><img src="{{ asset('images/banner.jpg') }}" alt="" class="image image-full" /> </p>
      <div class="article-body">
        {!! $article->body !!}
      </div>
    </div>
  </div>
</div>
@endsection