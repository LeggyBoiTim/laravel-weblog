@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Edit Article</h1>
<form action="{{ route('articles.update', $article->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="{{ $article->title }}" required>
    <br>
    <label for="content">Content:</label>
    <textarea id="content" name="content">{{ $article->content }}</textarea>
    <br>
    <button type="submit">Save</button>
</form>
@endsection