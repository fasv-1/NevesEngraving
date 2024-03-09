@extends('layouts.app')

@section('content')
  <navbar-component :altroutes = true>
    @auth
      <a href={{route('profile.edit')}}>Profile</a>
      <form action={{ route('logout')}} method="post">
        @csrf
        <button type="submit" class="button-1">Logout</button> 
      </form>
    
    @endauth
  </navbar-component>
  <profile-component :user = "{{$user}}" token = "{{$token}}"></profile-component>
@endsection
