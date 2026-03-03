@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Article List</h1>
    <table style="border-collapse: collapse;">
        <tbody>
            @foreach ($sortedArticles as $article)
                <tr>
                    <td style="height: 3em;">
                        <a style="margin-right: 0.5em;" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                        <br>
                        <small>Posted at: {{ $article->created_at->format('Y-m-d H:i') }}</small>
                    </td>
                    <td><a href="{{ route('articles.edit', $article->id) }}"><button style="margin: 0.2em;">Edit</button></a></td>
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