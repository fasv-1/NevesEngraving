@extends('layouts.app')

@section('content')
    <navbar-component :altroutes=false :key=$store.state.componentKey>
        @auth
            <!-- Used the auth tag to show the user name and an profile dropdown -->
            <div class="hello">

                <p><b> Hi {{ auth()->user()->name }}</b></p>
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

            <a href={{ route('login') }}><p><b>MY ACCOUNT</b></p></a>
        @endguest
    </navbar-component>

    <router-view></router-view>
    <services-component></services-component>
    <footer-component></footer-component>
@endsection
