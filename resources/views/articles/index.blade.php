@extends('layout')

@section('content')
<div id="wrapper">
  <div id="page" class="container">
    <div>
      <a class="btn btn-danger mb-4" href="{{ route('create-article') }}">Create new article</a>
    </div>
    @foreach ($articles as $article)
      <div id="content" class="mb-5">
        <div class="title">
          <h2 class="mb-2"><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></h2>
          <span class="byline">{{ $article->created_at }}</span>
        </div>
        
        <p><img src="{{ asset('images/banner.jpg') }}" alt="" class="image image-full" /> </p>

        <p class="article-description">
          @if($article->description)
            {{ $article->description }}
          @else
            {!! \Illuminate\Support\Str::limit($article->body, 400, $end='...') !!}
          @endif
        </p>

        <div class="mt-4">
          <img src="{{ asset('images/avt.jpg') }}" alt="" class="avt-img" />
          <span class="author">{{ $article->author }}</span>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection