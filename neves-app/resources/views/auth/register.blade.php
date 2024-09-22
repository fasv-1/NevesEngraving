@extends('layouts.app')

@section('content')
    <navbar-component :altroutes=true>
        @guest
            <a href={{ route('login') }}><p><b>My Account</b></p></a>
        @endguest
    </navbar-component>
    <div class="form-cont">
        <div class="form-group">
            <register-component csrf_token="{{ @csrf_token() }}"></register-component>
        </div>
    </div>
    <footer-component></footer-component>
@endsection
