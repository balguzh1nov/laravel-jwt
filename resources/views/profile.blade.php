@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hello, {{ $user->name }}!</h1>
        <p>Email: {{ $user->email }}</p>

        <h2>Profile</h2>
        <img src="{{ $user->profile->avatar }}" alt="Avatar">
        <p>Bio: {{ $user->profile->bio }}</p>
    </div>
@endsection
