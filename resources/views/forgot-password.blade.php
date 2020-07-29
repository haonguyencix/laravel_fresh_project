@extends('authen-layout')

@section('authen-form')
<div class="form-wrapper">
  <form method="POST" action="{{route('forgot-password-post')}}">
    @csrf
    <div class="form-group">
      <input 
        name="email" 
        placeholder="Xác thực email" 
        type="email"
        class="form-control @if($errors->has('email')) is-invalid @endif" 
        value="{{ old('email') }}"
        {{-- required --}}
      > 

      @if($errors->has('email'))
        <p class="text-danger">{{ $errors->first('email') }}</p>
      @endif
    </div>
    <button type="submit" class="btn btn-danger w-100 mb-2">Gửi nhé</button>
    <a class="mb-2 d-block" href="{{route('login')}}">Về trang đăng nhập</a>
    @if(session('reset-password-link'))
      <a class="text-success" href="{{ session('reset-password-link') }}">Tới trang đổi mật khẩu</a>
    @elseif(session('email-not-exist'))
      <p class="text-danger">{{ session('email-not-exist') }}</p>
    @endif
  </form>
</div>
@endsection