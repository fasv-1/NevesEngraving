@extends('layouts.app')

@section('content')
    <navbar-component :altroutes=true>
        @guest
            <a href={{ route('login') }}><p><b>MY ACCOUNT</b></p></a>
        @endguest
    </navbar-component>
    <div class="container">
        <div class="card-center">

            <div class="card-header">
                <h1>Reset password</h1>
            </div>

            <div class="card-body">
                <form method="post" action={{ route('password.store') }}>
                    @csrf

                    <input type="hidden" name="token" class="form-email" value="{{ $token }}">
                    <input type="hidden" name="email" class="form-email" placeholder="E-mail"
                        value="{{ $email }}">

                    <div class="inputContainer l-input">
                        <div class="form-label">
                            <label for="password">New Password:</label>
                        </div>
                        <input type="password" name="password" class="form-email" placeholder="Password">
                        <div id="help" class="form-help">Your new password</div>
                        @if ($errors->has('password'))
                            <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="inputContainer l-input">
                        <div class="form-label">
                            <label for="password_confirmation">Confirm Password:</label>
                        </div>
                        <input type="password" name="password_confirmation" class="form-email"
                            placeholder="Confirm-Password">
                        <div id="help" class="form-help">Confirm password</div>

                        @if ($errors->has('password'))
                            <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="button-form">
                        <div class="btn-pass">
                            <button type="submit" class="button-login">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer-component></footer-component>
@endsection
