<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
  public function login()
  {
    request()->validate([
      'email' => ['required', 'email'],
      'password' => ['required', 'min:8'],
    ], [
      'email.required' => 'Email là bắt buộc nhập nha bạn!',
      'email.email' => 'Email phải đúng dạng nha bạn!',
      'password.required' => 'Password là bắt buộc nhập nha bạn!',
      'password.min' => 'Password ít nhất phải nhập 8 ký tự nha bạn!',
    ]);

    $user = User::where('email', request('email'))->firstOrFail();

    $validCredentials = Hash::check(request('password'), $user->getAuthPassword());

    if ($validCredentials) {
      return redirect('home');
    }
    return view('login')->with('fail', 'Email hoặc mật khẩu không đúng!');
  }
}
