<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/posts/{post}', function ($post) { // {post} -> query params trên thanh address của trình duyệt
//     $posts = [
//         'first-post' => 'This is my first post!',
//         'second-post' => 'Hello, yeah yeah my second post!'
//     ];

//     if(!array_key_exists($post, $posts)) {
//         abort(404, 'Sorry!');
//     };

//     return view('post', [ // 'post' -> dùng file view là post.blade.php
//         'post' => $posts[$post] // 'post' -> biến để binding data bên view; $posts -> biến là một JSON; $post -> query params lấy bằng cách truyền như tham số của function
//     ]);
// });

Route::view('/', 'login')->name('login');
Route::view('/register', 'register')->name('register');
Route::view('/forgot-password', 'forgot-password')->name('forgot-password');
Route::get('/reset-password/{token}', 'LoginController@checkToken')->name('check-reset-password');
Route::view('/reset-password', 'reset-password')->name('reset-password');
Route::view('/home', 'home')->name('home');
Route::post('/login-post', 'LoginController@login')->name('login-post');
Route::post('/register-post', 'LoginController@register')->name('register-post');
Route::post('/forgot-password-post', 'LoginController@forgotPassword')->name('forgot-password-post');
Route::post('/reset-password-post', 'LoginController@resetPassword')->name('reset-password-post');
Route::get('/logout', 'LoginController@logout')->name('logout');
// Route::get('/about', function() {
//   return view('about', [
//     'articles' => App\Article::take(3)->latest()->get()
//   ]);
// });
