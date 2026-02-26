@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>{{ $article->title }}</h1>
    <p>{{ $article->content }}</p>
    <a href="{{ route('articles.index') }}">Back to Articles</a>
    <h2>Comments</h2>
    @foreach($article->comments as $comment)
        <div>
            <p>{{ $comment->content }}</p>
            <small>By {{ $comment->user->name }}</small>
        </div>
    @endforeach
@endsection