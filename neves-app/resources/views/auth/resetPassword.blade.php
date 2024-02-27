@extends('layouts.app')

@section('content')

  <div class="form-cont">
    <div class="form-group">
      <form method="post" action = {{ route('password.email') }}>
      @csrf
      <label for="email">Place you email adress to change your password</label>
      <input type="email" name="email" class="form-email" placeholder="E-mail">

     <button type="submit" class="button-1">Submit</button> 
      </form>
    </div>
    {{$errors}}
  </div>
@endsection