<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
  public function index()
  {
    $articles = Article::latest()->get();

    return view('articles.index', ['articles' => $articles]);
  }
  public function show($id)
  {
    $article = Article::find($id);

    return view('articles.show', ['article' => $article]);
  }
  public function create()
  {
    return view('articles.create');
  }
  public function store(Request $req)
  {
    $article = new Article();

    $article->title = request('title');
    $article->description = request('description');
    $article->body = request('article-ckeditor');

    if($req->session()->has('credential')) {
      $article->author = $req->session()->get('credential');
    } else {
      $article->author = 'Unknown';
    };

    $article->save();

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
