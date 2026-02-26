@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>{{ $article->title }}</h1>
    <p>{{ $article->content }}</p>
    <a href="{{ route('articles.index') }}">Back to Articles</a>
@endsection