@extends('layouts.app')

@section('content')
  <navbar-component>
    @auth
        <a href={{route('profile.edit')}}>Profile</a>
        <form action={{ route('logout')}} method="post">
        @csrf
        <button type="submit" class="button-1">Logout</button> 
      </form>
      {{-- @endif --}}
      
  @endauth
  @guest
  <a href={{route('login')}}>Login/Signup</a>
  @endguest
  </navbar-component>

  <router-view ></router-view>
@endsection



