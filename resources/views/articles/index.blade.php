@extends('layouts.app')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>

    <label for="categoryFilter">Filter by category:</label>
    <select id="categoryFilter" onchange="window.location.href = this.value">
        <option value="{{ route('articles.index') }}">All Categories</option>
        @forelse ($sortedCategories as $category)
            <option value="{{ route('categories.show', $category) }}" {{ request()->routeIs('categories.show') && request()->route('category') === $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @empty
            <option disabled>No categories available</option>
        @endforelse
    </select>
    <br><br>

    @forelse ($sortedArticles as $article)
        <div style="height: 3em;">
            <a style="margin-right: 0.5em;" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
            <br>
            <small>Posted by: {{ $article->user->name }}</small>
            <small style="margin-left: 1em;">Posted at: {{ $article->created_at->format('Y-m-d H:i') }}</small>
            <br>
            <small>Categories: 
                @forelse ($article->categories->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE) as $category)
                    <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>{{ !$loop->last ? ',' : '' }}
                @empty
                    No categories
                @endforelse
            </small>
        </div>
        <br>
    @empty
        <p>No articles found.</p>
    @endforelse
@endsection