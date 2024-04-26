@extends('layouts.app')

@section('content')
    <navbar-component :altroutes=false>
        @auth
            <div class="hello">
                <h6> Hi {{ auth()->user()->name }}</h6>
                <div id="drop-profile">
                    <ul>
                        <li>
                            <a href={{ route('profile.edit') }}>Profile</a>
                        </li>
                        <li class="logout">
                            <form action={{ route('logout') }} method="post">
                                @csrf
                                <button type="submit" class="button">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        @endauth
        @guest
            <a href={{ route('login') }}>Login/Signup</a>
        @endguest
    </navbar-component>

    <router-view></router-view>
    <footer-component></footer-component>
@endsection
