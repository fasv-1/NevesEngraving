@extends('layouts.app')

@section('content')

  <div class="form-cont">
    <div class="form-group">
      <form method="post" action = {{ route('verification.send') }}>
        @csrf
        <p>An email was sent to your email adress, please check your email</p>
        <label for="resent-email-conf">To resent email confirmation, please click in the button below.</label>
        <button type="submit" name="resent-email-conf" class="button-1">Submit</button> 
      </form>
    </div>
    {{$errors}}
  </div>
@endsection
