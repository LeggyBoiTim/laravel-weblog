@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <h1 style="margin-bottom: 0;">{{ $article->title }} @if ($article->is_premium)<span style="color: gold; font-weight: bold;">[Premium]</span>@endif</h1>
    <small>Posted by: {{ $article->user->name }}</small>
    <small style="margin-left: 1em;">Posted at: {{ $article->created_at->format('Y-m-d H:i') }}</small>
    <small style="margin-left: 1em;">Categories: 
        @forelse ($article->categories->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE) as $category)
            <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>{{ !$loop->last ? ',' : '' }}
        @empty
            No categories
        @endforelse
    </small>
    <br>

    @if ($article->image_path)
        <div>
            <img src="{{ asset('storage/' . $article->image_path) }}" alt="Article Image" style="max-width: 100%; height: auto;">
        </div>
    @endif

    <p>{{ $article->content }}</p>

    <a href="{{ route('articles.my-articles') }}"><button>Back to My Articles</button></a>
    @if (Auth::id() === $article->user_id)
        <a href="{{ route('articles.edit', $article) }}"><button>Edit</button></a>
        <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        @if ($article->image_path)
            <form action="{{ route('articles.destroy-image', $article) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete Image</button>
            </form>
        @endif
    @endif
    <hr>

    <h2>Comments</h2>

    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <label for="content">Add a Comment:</label>
        <br>
        <textarea style="width: 50%; height: 5em;" id="content" name="content" required></textarea>
        <br>
        <button type="submit">Post Comment</button>
    </form>
    <br>

    @forelse($article->comments as $comment)
        <div style="display: flex; align-items: center;">
            <div style="margin-right: 1em;">
                <small style="font-weight: bold;">{{ $comment->user->name }}</small>
                <small style="margin-left: 0.2em;">{{ $comment->created_at->diffForHumans() }}</small>
                <p style="margin-top: 0;">{{ $comment->content }}</p>
            </div>
            <div>
                @if (Auth::id() === $comment->user_id)
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p style="margin-top: 0;">No comments yet.</p>
    @endforelse
@endsection