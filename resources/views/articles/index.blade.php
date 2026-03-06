@extends('layouts.app')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    @forelse ($sortedArticles as $article)
        <div style="height: 3em;">
            <a style="margin-right: 0.5em;" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
            <br>
            <small>Posted by: {{ $article->user->name }}</small>
            <small style="margin-left: 1em;">Posted at: {{ $article->created_at->format('Y-m-d H:i') }}</small>
        </div>
    @empty
        <p>No articles found.</p>
    @endforelse
@endsection