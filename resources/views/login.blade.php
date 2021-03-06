@extends('authen-layout')

@section('authen-form')
<div class="form-wrapper">
  <h1 class="text-center mb-4">Login</h1>
  <form method="POST" action="{{route('login-post')}}">
    @csrf
    <div class="form-group">
      <input 
        name="email" 
        placeholder="Email address" 
        type="email"
        class="form-control @if($errors->has('email')) is-invalid @endif" 
        value="{{ old('email') }}"
        {{-- required --}}
      > 

      @if($errors->has('email'))
        <p class="text-danger">{{ $errors->first('email') }}</p>
      @endif
    </div>
    <div class="form-group">
      <input 
        name="password" 
        placeholder="Password" 
        type="password"
        class="form-control @if($errors->has('password')) is-invalid @endif"
        value="{{ old('password') }}"
        {{-- required --}}
      >

      @if($errors->has('password'))
        <p class="text-danger">{{ $errors->first('password') }}</p>
      @endif
    </div>
    <button type="submit" class="btn btn-success w-100 mb-2">Đăng nhập</button>
    <a class="mb-2 d-block" href="{{route('register')}}">Bạn chưa có tài khoản?</a>
    <a class="mb-2 d-block" href="{{route('forgot-password')}}">Bị quên mật khẩu?</a>
    @if(session('fail'))
      <p class="text-danger">{{ session('fail') }}</p>
    @elseif(session('register-success'))
      <p class="text-success">{{ session('register-success') }}</p>
    @endif
  </form>
</div>
@endsection