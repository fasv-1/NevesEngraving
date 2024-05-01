@extends('layouts.app')

@section('content')
    <div class="card-center">
        <div class="verify-card">
            <div class="card-body">
                <div class="button-form">
                    <div class="card-header">
                        <h1>Verify your email</h1>
                    </div>
                    <form method="post" action={{ route('verification.send') }}>
                        @csrf
                        <h6>Before you enter in your personal areal please verify your email.</h6>
                        <br>
                        <h6>An verification email was sent to your email adress.</h6>
                        <br>
                        <h6>If you didn't receive a verification email, please click in the button</h6>
                        <h6> below to resent email confirmation.</h6>
                        <div class="btn-pass mrgvert2">
                            <button type="submit" name="resent-email-conf" class="button1">Submit</button>
                        </div>
                    </form>
                    <a href="/home" class="btn-pass mrgvert2">
                        <h4>Continue to navigate</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
