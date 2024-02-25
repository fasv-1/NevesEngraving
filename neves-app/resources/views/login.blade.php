@extends('layouts.app')

@section('content')

  <div class="form-cont">
    <div class="form-group">
      <form method="post" action = {{ route('login') }}>
      {{-- @csrf --}}
      <input type="email" name="email" class="form-email" placeholder="E-mail">
      <input type="password" name="password" class="form-password" placeholder="Password">

     <button type="submit" class="button-1">Submit</button> 
      </form>
    </div>
    {{$errors}}
  </div>
@endsection