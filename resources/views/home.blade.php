@extends('layout')

@section('content')
<div id="wrapper">
  <div id="page" class="container">
    <div id="content w-100">
      <h1 class="text-center py-5">Hello {{ session('user_name') }}, welcome to HaroBlog!</h1>
    </div>
  </div>
</div>
@endsection