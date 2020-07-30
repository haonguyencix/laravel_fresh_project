@extends('layout')

@section('content')
<div id="wrapper">
  <div id="page" class="container">
    <div id="content">
      <div class="title">
        <h2>{{ $article->title }}</h2>
        <span class="byline">{{ $article->created_at->format('H:i d.m.Y') }}</span>
      </div>
      <p><img src="{{ asset('images/banner.jpg') }}" alt="" class="image image-full" /></p>
      <div class="article-body">
        {!! $article->body !!}
      </div>
      <div class="card my-4 p-4">
        <div class="d-flex align-items-center">
          <img src="{{ asset('images/avt.jpg') }}" class="card-img avt-img mr-3" width="60px" alt="">
          <div>
            <h5 style="margin-bottom: 4px">By <b>{{ $article->author->name }}<b></h5>
            <span style="font-weight: normal; font-size: 16px;">{{ $article->author->email }}</span>
          </div>
        </div>
      </div>
      <div>
        @foreach ($article->tags as $tag)
          <a class="article-tag-item" style="font-weight: normal" href="{{ route('articles', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection