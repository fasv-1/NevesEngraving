@extends('layouts.app')

@section('content')
    <navbar-component :altroutes=true>
        @guest
            <a href={{ route('login') }}>My Account</a>
        @endguest
    </navbar-component>
    <div class="container">
        <div class="card-center">
            <div class="card-header">
                <h1>Reset password</h1>
            </div>
            <div class="card-body">
                <form method="post" action={{ route('password.email') }}>
                    @csrf
                    <div class="inputContainer l-input">

                        <div class="form-label">
                            <label for="email">Email</label>
                        </div>
                        <input type="email" name="email" class="form-email" placeholder="E-mail">
                        <div id="help" class="form-help">Place youe email for us to send an reset password link</div>

                        @if ($errors->has('email'))
                            <div class="error">{{ $errors->first('email') }}</div>
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
@endsection
