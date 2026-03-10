@extends('layouts.app')

@section('title', 'Edit Article')

@section('content')
    <h1>Edit Article</h1>
    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input style="margin-bottom: 1em;" type="text" id="title" name="title" value="{{ $article->title }}" required>
        <br>
        <label>Categories:</label>
        @foreach ($categories as $category)
            <input style="margin-bottom: 1em; margin-right: 0em;" type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}" {{ $article->categories->contains($category) ? 'checked' : '' }}>
            <label style="margin-right: 0.5em;" for="category-{{ $category->id }}">{{ $category->name }}</label>
        @endforeach
        <br>
        <label for="content">Content:</label>
        <textarea style="margin-bottom: 1em; width: 100%; height: 20em;" id="content" name="content">{{ $article->content }}</textarea>
        <br>
        <button type="submit">Save</button>
    </form>
@endsection