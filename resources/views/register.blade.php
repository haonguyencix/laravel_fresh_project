@extends('authen-layout')

@section('authen-form')
<div class="form-wrapper">
  <h1 class="text-center mb-4">Register</h1>
  <form method="POST" action="{{route('register-post')}}">
    @csrf
    <div class="form-group">
      <input 
        name="name" 
        placeholder="Name" 
        type="text"
        class="form-control @if($errors->has('name')) is-invalid @endif" 
        value="{{ old('name') }}"
        {{-- required --}}
      > 

      @if($errors->has('name'))
        <p class="text-danger">{{ $errors->first('name') }}</p>
      @endif
    </div>
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
    <button type="submit" class="btn btn-warning w-100 mb-2">Đăng ký</button>
    <a class="mb-2 d-block" href="{{route('login')}}">Về trang đăng nhập</a>
    @if(session('register-fail'))
      <p class="text-danger">{{ session('register-fail') }}</p>
    @endif
  </form>
</div>
@endsection