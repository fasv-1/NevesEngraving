@extends('layouts.app')

@section('content')

  <div class="form-cont">
    <div class="form-group">
      {{-- Email - {{$email}}
      Token - {{$token}} --}}

      <form method="post" action = {{ route('password.store') }}>
      @csrf
      <input type="hidden" name="token" class="form-email" value="{{$token}}">
      <input type="email" name="email" class="form-email" placeholder="E-mail" value="{{$email}}">
      <label for="password">Type a new password</label>
      <input type="password" name="password" class="form-email" placeholder="Password" >
      
      <label for="password">Confirm password</label>
      <input type="password" name="password_confirmation" class="form-email" placeholder="Password" >

     <button type="submit" class="button-1">Submit</button> 

    </div>
    {{$errors}}
  </div>
@endsection