<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
  public function index()
  {
    if(request('tag')) {
      $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
    } else {
      $articles = Article::latest()->get();
    }

    $tag = Tag::take(10)->latest()->get();

    return view('articles.index', [
      'articles' => $articles,
      'tags' => $tag
    ]);
  }
  public function show($id)
  {
    $article = Article::find($id);

    return view('articles.show', ['article' => $article]);
  }
  public function create()
  {
    return view('articles.create', ['tags' => Tag::all()]);
  }
  public function store(Request $req)
  {
    $article = new Article();

    $article->title = request('title');
    $article->description = request('description');
    $article->body = request('article-ckeditor');

    if($req->session()->has('credential')) {
      $article->user_id = $req->session()->get('credential');
    } else {
      $article->user_id = 0;
    };

    $article->save();

    $article->tags()->attach(request('tags'));

    return redirect('/articles');
  }
  public function edit()
  {

  }
  public function update()
  {

  }
  public function destroy()
  {

  }
}
