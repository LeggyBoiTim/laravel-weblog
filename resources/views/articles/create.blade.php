@extends('layouts.app')

@section('title', 'New Article')

@section('content')
    <h1>New Article</h1>
    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input style="margin-bottom: 1em;" type="text" id="title" name="title" required>
        <br>
        @if ($categories->isEmpty())
            <label>Categories: No categories available.</label>
            <br>
        @else
            <label>Categories:</label>
            @foreach ($categories as $category)
                <input style="margin-right: 0em;" type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                <label style="margin-right: 0.5em;" for="category-{{ $category->id }}">{{ $category->name }}</label>
            @endforeach
            <br>
        @endif
        <br>
        <label for="content">Content:</label>
        <textarea style="margin-bottom: 1em; width: 100%; height: 20em;" id="content" name="content"></textarea>
        <br>
        <button type="submit">Post</button>
    </form>
@endsection