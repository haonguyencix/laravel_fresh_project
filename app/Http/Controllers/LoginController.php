<?php

namespace App\Http\Controllers;

use App\User;
use App\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
      session(['credential' => $user->id]);
      session(['user_name' => $user->name]);
      return redirect('/home');
    }
    return redirect('/')->with('fail', 'Email hoặc mật khẩu không đúng!');
  }
  public function logout(Request $req)
  {
    if($req->session()->has('credential') and $req->session()->has('user_name')) {
      $req->session()->forget('credential');
      $req->session()->forget('user_name');
    }
    return redirect('');
  }
  public function register()
  {
    request()->validate([
      'name' => 'required',
      'email' => ['required', 'email'],
      'password' => ['required', 'min:8'],
    ], [
      'name.required' => 'Gõ tên là điều bắt buộc bạn à!',
      'email.required' => 'Email là bắt buộc nhập nha bạn!',
      'email.email' => 'Email phải đúng dạng nha bạn!',
      'password.required' => 'Password là bắt buộc nhập nha bạn!',
      'password.min' => 'Password ít nhất phải nhập 8 ký tự nha bạn!',
    ]);

    if(User::where('email', request('email'))->exists()) {
      return redirect('/register')->with('register-fail', 'Email bạn gõ đã tồn tại!');
    }

    $user = new User();
    $user->name = request('name');
    $user->email = request('email');
    $user->password = Hash::make(request('password'));
    $user->save();

    return redirect('/')->with('register-success', 'Đăng ký thành công! Mời bạn đăng nhập');
  }
  public function forgotPassword()
  {
    request()->validate([
      'email' => ['required', 'email'],
    ], [
      'email.required' => 'Email là bắt buộc nhập nha bạn!',
      'email.email' => 'Email phải đúng dạng nha bạn!'
    ]);

    $result = User::where('email', request('email'))->firstOrFail();
    if ($result) {
      $passwordReset = new PasswordReset();
      $passwordReset->email = request('email');
      $passwordReset->token = Str::random(60);
      $passwordReset->save();

      $token = PasswordReset::where('email', request('email'))->firstOrFail();
      
      return redirect('/forgot-password')->with('reset-password-link', url('reset-password') . "/" . $token->token);
    } else {
      return redirect('/forgot-password')->with('email-not-exist', 'Email không tồn tại trong hệ thống!');
    }
  }
  public function checkToken($token)
  {
    $existedToken = PasswordReset::where('token', $token)->firstOrFail();

    $data['info'] = $existedToken->token;

    if($existedToken){
      return view('reset-password', $data);
    } else {
      echo 'This link is expired';
    }
  }
  public function resetPassword()
  {
    request()->validate([
      'password' => ['required', 'min:8'],
      'confirm' => ['required', 'min:8'],
    ], [
      'password.required' => 'Password là bắt buộc nhập nha bạn!',
      'password.min' => 'Password ít nhất phải nhập 8 ký tự nha bạn!',
      'confirm.required' => 'Password là bắt buộc nhập nha bạn!',
      'confirm.min' => 'Password ít nhất phải nhập 8 ký tự nha bạn!',
    ]);
    
    if (request('password') == request('confirm')) {
      $existed = PasswordReset::where('token', request('token'))->firstOrFail();

      User::where('email', $existed->email)->update(['password' => Hash::make(request('password'))]);

      PasswordReset::where('token', request('token'))->delete();

      return redirect('/');
    } else {
      echo "Password doesn't match";
    }
  }
}
