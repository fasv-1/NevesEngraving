@extends('layouts.app')

@section('content')
    <navbar-component :altroutes=true>
        @guest
            <a href={{ route('login') }}>Login/Signup</a>
        @endguest
    </navbar-component>
    <div class="form-cont">
        <div class="form-group">
            <register-component csrf_token="{{ @csrf_token() }}"></register-component>
            {{-- <form method="post" action = {{ route('register') }}>
      @csrf
      <input type="text" name="name" class="form-name" placeholder="First name">
      {{$errors->has('name') ? $errors->first('name') : ''}}
      <input type="email" name="email" class="form-email" placeholder="E-mail">
      {{$errors->has('email') ? $errors->first('email') : ''}}
      <input type="password" name="password" class="form-password" placeholder="Password">
      <input type="password" name="password_confirmation" class="form-password" placeholder="Password">
      {{$errors->has('password') ? $errors->first('password') : ''}}
     <button type="submit" class="button-1">Submit</button> 
      </form> --}}
        </div>
    </div>
@endsection
