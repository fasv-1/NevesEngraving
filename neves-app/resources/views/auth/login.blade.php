@extends('layouts.app')

@section('content')
    <navbar-component :altroutes=true>
        @guest
            <a href={{ route('login') }}><p><b>MY ACCOUNT</b></p></a>
        @endguest
    </navbar-component>
    <login-component csrf_token="{{ @csrf_token() }}"></login-component>

    {{-- <div class="form-cont">
    <div class="form-group">
      <form method="post" action = {{ route('login') }}>
      @csrf
      <input type="email" name="email" class="form-email" placeholder="E-mail">
      <input type="password" name="password" class="form-password" placeholder="Password">

     <button type="submit" class="button-1">Submit</button>
      </form>
    </div> --}}
    {{-- <a href="{{ route('password.request')}}">Forgot your password?</a>
    {{$errors}} --}}
    <footer-component></footer-component>
@endsection
