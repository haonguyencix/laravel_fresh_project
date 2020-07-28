@extends('authen-layout')

@section('login-form')
<div class="form-wrapper">
  <h1 class="text-center mb-4">Login</h1>
  <form method="POST" action="/login">
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
    <button type="submit" class="btn btn-success w-100">Submit</button>
    @if(session('fail'))
      <p class="text-danger">{{ session('fail') }}</p>
    @endif
  </form>
</div>
@endsection