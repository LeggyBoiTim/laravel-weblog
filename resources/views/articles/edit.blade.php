@extends('layouts.app')

@section('title', 'Edit Article')

@section('content')
    <h1>Edit Article</h1>

    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $article->title }}" required>
        <br><br>

        @if ($categories->isEmpty())
            <span>Categories: No categories available.</span>
            <br><br>
        @else
            <span>Categories:</span>
            @foreach ($categories as $category)
                <input style="margin-right: 0em;" type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}" {{ $article->categories->contains($category) ? 'checked' : '' }}>
                <label style="margin-right: 0.5em;" for="category-{{ $category->id }}">{{ $category->name }}</label>
            @endforeach
            <br><br>
        @endif
        
        @if (Auth::user()->has_premium)
            <label for="is_premium">Premium:</label>
            <input type="checkbox" id="is_premium" name="is_premium" value="1" {{ $article->is_premium ? 'checked' : '' }}>
            <br><br>
        @endif

        <label for="content">Content:</label>
        <textarea style="width: 100%; height: 20em;" id="content" name="content">{{ $article->content }}</textarea>
        <br><br>
        
        <label for="image">{{ $article->image_path ? 'Update' : 'Upload' }} image:</label>
        <input type="file" id="image" name="image" accept="image/*" title="Upload image">
        <br><br>

        <button type="submit">Save</button>
    </form>
@endsection