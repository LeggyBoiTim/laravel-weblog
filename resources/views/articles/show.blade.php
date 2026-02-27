@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1 style="margin-bottom: 0;">{{ $article->title }}</h1>
    <small>By: {{ $article->user->name }}</small>
    <small style="margin-left: 1em;">Posted at: {{ $article->created_at->format('Y-m-d H:i') }}</small>
    <p>{{ $article->content }}</p>
    <a href="{{ route('articles.index') }}">Back to Articles</a>
    <hr>
    <h2>Comments</h2>
    @foreach($article->comments as $comment)
        <div>
            <small>{{ $comment->user->name }}:</small>
            <p style="margin-top: 0.5em;">{{ $comment->content }}</p>
        </div>
    @endforeach
@endsection