@extends('layouts.app')

@section('content')
  <profile-component :user = "{{$user}}" token = "{{$token}}"></profile-component>
  @endsection
