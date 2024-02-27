@extends('layouts.app')

@section('content')

  <div class="form-cont">
    <div class="form-group">
      <form method="post" action = {{ route('register') }}>
      @csrf
      <input type="text" name="name" class="form-name" placeholder="First name">
      <input type="text" name="last_name" class="form-name" placeholder="Last name">
      {{-- {{$errors->has('name') ? $errors->first('name') : ''}} --}}
      <input type="email" name="email" class="form-email" placeholder="E-mail">
      <input type="text" name="phone_number" class="form-phone" placeholder="Phone number">
      <input type="number" name="administrador" class="form-administrador" placeholder="Administrador">
      {{-- {{$errors->has('email') ? $errors->first('email') : ''}} --}}
      <input type="password" name="password" class="form-password" placeholder="Password">
      <input type="password" name="password_confirmation" class="form-password" placeholder="Password">
      {{-- {{$errors->has('password') ? $errors->first('password') : ''}} --}}
     <button type="submit" class="button-1">Submit</button> 
      </form>
    </div>
    {{$errors}}
  </div>
@endsection