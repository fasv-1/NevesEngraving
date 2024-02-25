@extends('layouts.app')

@section('content')
<navbar-component></navbar-component>
<form action={{ route('logout')}} method="post">
@csrf
<button type="submit" class="button-1">Logout</button> 
</form>
@auth
<router-view login="{{Route::has('login')}}" create="{{Route::has('create')}}"></router-view>
@endauth
@endsection



