@extends('layout')

@section('content')
<div id="wrapper">
  <div id="page" class="container px-2">
    <h1 class="mb-4">New Article</h1>
    
    <form action="{{ route('store-article') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="Title">
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows="2" value="{{ old('description') }}"></textarea>
      </div>
  
      <div class="form-group">
        <label for="article-ckeditor">Content</label>
        <textarea name="article-ckeditor" id="article-ckeditor" value="{{ old('article-ckeditor') }}"></textarea>
      </div>

      {{-- <div class="form-group">
        <label for="tags">Tags</label>
        <select class="form-control" name="tags[]" multiple id="tags">
          @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
          @endforeach
        </select>
      </div> --}}

      <div class="mb-3">
        @foreach ($tags as $tag)
          <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" name="tags[]" id="{{ $tag->id }}" value="{{ $tag->id }}" style="cursor: pointer">
            <label class="custom-control-label" for="{{ $tag->id }}" style="cursor: pointer">{{ $tag->name }}</label>
          </div>
        @endforeach
      </div>

      <div class="d-flex">
        <a href="{{ route('articles') }}" type="button" class="btn btn-danger mr-2">Cancel</a>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </form>
  </div>
</div>
@endsection