@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>New Article</h1>
    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="content">Content:</label>
        <textarea id="content" name="content"></textarea>
        <br>
        <button type="submit">Post</button>
    </form>
@endsection