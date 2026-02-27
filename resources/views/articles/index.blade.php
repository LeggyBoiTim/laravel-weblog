@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Articles</h1>
    <table style="border-collapse: collapse;">
        <tbody>
            @foreach ($sortedArticles as $article)
                <tr>
                    <td style="height: 3em;">
                        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                        <br>
                        <small>Posted at: {{ $article->created_at->format('Y-m-d H:i') }}</small>
                    </td>
                    <td style="padding: 1em;"><a href="{{ route('articles.edit', $article->id) }}">Edit</a></td>
                    <td>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection