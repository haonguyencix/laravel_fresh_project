@extends('layout')

@section('content')
<div id="wrapper">
  <div id="page" class="container">
    <div class="mb-4">
      @foreach ($tags as $tag)
        <a class="article-tag-item" href="{{ route('articles', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
      @endforeach
    </div>
    <div>
      <a style="border-radius: 20px;" class="btn btn-danger mb-4" href="{{ route('create-article') }}">Create new article</a>
    </div>
    @forelse ($articles as $article)
      <div id="content" class="mb-5">
        <div class="title">
          <h2 class="mb-2"><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></h2>
          <span class="byline">{{ $article->created_at->format('H:i d.m.Y') }}</span>
        </div>
        
        <p><img src="{{ asset('images/banner.jpg') }}" alt="" class="image image-full" /> </p>

        <p class="article-description">
            {!! \Illuminate\Support\Str::limit($article->description ?? $article->body, 400, $end='...') !!}
        </p>

        <div class="mt-4">
          <img src="{{ asset('images/avt.jpg') }}" alt="" class="avt-img" />
          <span class="author">{{ $article->author->name }}</span>
        </div>
      </div>
    @empty
      <h2>No relevant article</h2>
    @endforelse
  </div>
</div>
@endsection