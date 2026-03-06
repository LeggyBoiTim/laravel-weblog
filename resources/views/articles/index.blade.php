@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>My Articles</h1>
    <table style="border-collapse: collapse;">
        <tbody>
            @forelse ($sortedArticles as $article)
                <tr>
                    <td style="height: 3em;">
                        <a style="margin-right: 0.5em;" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                        <br>
                        <small>Posted by: {{ $article->user->name }}</small>
                        <small style="margin-left: 1em;">Posted at: {{ $article->created_at->format('Y-m-d H:i') }}</small>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>No articles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection