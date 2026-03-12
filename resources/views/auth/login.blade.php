@extends('layouts.app')

@section('title', 'Log in')

@section('content')
    <h1>Log in</h1>
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input style="margin-bottom: 1em; width: 10%;" type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input style="margin-bottom: 1em; width: 10%;" type="password" id="password" name="password" required>
        <br>
        @include('errors.error', ['name' => 'email'])
        @include('errors.error', ['name' => 'password'])
        <button type="submit">Log in</button>
    </form>
@endsection