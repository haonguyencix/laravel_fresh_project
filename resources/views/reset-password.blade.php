@extends('authen-layout')

@section('authen-form')
<div class="form-wrapper">
  <form method="POST" action="{{route('reset-password-post')}}">
    @csrf
    <input type="text" name="token" value="{{ $info }}" hidden>
    <div class="form-group">
      <input 
        name="password" 
        placeholder="New password" 
        type="password"
        class="form-control @if($errors->has('password')) is-invalid @endif"
        value="{{ old('password') }}"
        {{-- required --}}
      >

      @if($errors->has('password'))
        <p class="text-danger">{{ $errors->first('password') }}</p>
      @endif
    </div>
    <div class="form-group">
      <input 
        name="confirm" 
        placeholder="Confirm password" 
        type="password"
        class="form-control @if($errors->has('confirm')) is-invalid @endif"
        value="{{ old('confirm') }}"
        {{-- required --}}
      >

      @if($errors->has('confirm'))
        <p class="text-danger">{{ $errors->first('confirm') }}</p>
      @endif
    </div>
    <button type="submit" class="btn btn-primary w-100 mb-2">Đổi mật khẩu</button>
  </form>
</div>
@endsection