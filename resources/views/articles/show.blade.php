@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1 style="margin-bottom: 0;">{{ $article->title }}</h1>
    <small>Posted by: {{ $article->user->name }}</small>
    <small style="margin-left: 1em;">Posted at: {{ $article->created_at->format('Y-m-d H:i') }}</small>
    <p>{{ $article->content }}</p>
    <a href="{{ route('articles.index') }}"><button>Back to Articles</button></a>
    <a href="{{ route('articles.edit', $article) }}"><button>Edit</button></a>
    <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    <hr>
    <h2>Comments</h2>
    @forelse($article->comments as $comment)
        <div>
            <small style="font-weight: bold;">{{ $comment->user->name }}:</small>
            <p style="margin-top: 0;">{{ $comment->content }}</p>
        </div>
    @empty
        <p>No comments yet.</p>
    @endforelse
@endsection