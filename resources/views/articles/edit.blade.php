@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Edit Article</h1>
    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input style="margin-bottom: 1em;" type="text" id="title" name="title" value="{{ $article->title }}" required>
        <br>
        <label for="content">Content:</label>
        <textarea style="margin-bottom: 1em; width: 100%; height: 20em;" id="content" name="content">{{ $article->content }}</textarea>
        <br>
        <button type="submit">Save</button>
    </form>
@endsection