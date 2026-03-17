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

    @if (request()->routeIs('articles.premium-articles') && !Auth::user()->has_premium)
        <p style="margin-top: 0;">No access to premium articles.</p>
        <form action="{{ route('users.upgrade-premium') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">Upgrade to Premium</button>
        </form>
    @endif

    @forelse ($sortedArticles as $article)
        @if (!($article->is_premium && !Auth::user()->has_premium))
            <div style="height: 3em;">
                <a style="margin-right: 0.5em;" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                @if ($article->is_premium)
                    <span style="color: gold; font-weight: bold;">[Premium]</span>
                @endif
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
        @endif
    @empty
        <p style="margin: 0;">No articles found.</p>
    @endforelse
@endsection