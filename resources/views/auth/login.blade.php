@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Login</h1>
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input style="margin-bottom: 1em; width: 10%;" type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input style="margin-bottom: 1em; width: 10%;" type="password" id="password" name="password" required>
        <br>
        @include('forms.error', ['name' => 'email'])
        @include('forms.error', ['name' => 'password'])
        <button type="submit">Log in</button>
    </form>
@endsection