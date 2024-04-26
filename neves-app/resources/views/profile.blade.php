@extends('layouts.app')

@section('content')
    <navbar-component :altroutes=true>
        @auth
            <div class="hello">
                <h6><a href="#drop-profile"> Hi {{ auth()->user()->name }}</a></h6>
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

    </navbar-component>
    <profile-component :user="{{ $user }}" token = "{{ $token }}"></profile-component>
    <footer-component></footer-component>
@endsection
