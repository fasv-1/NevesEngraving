@extends('layouts.app')

@section('content')
    <navbar-component :altroutes=false>
        @auth
        <!-- Used the auth tag to show the user name and an profile dropdown -->
            <div class="hello">
                <h6><b> Hi {{ auth()->user()->name }}</b></h6>
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
            <a href={{ route('login') }}>My Account</a>
        @endguest
    </navbar-component>

    <router-view></router-view>
    <footer-component></footer-component>
@endsection
