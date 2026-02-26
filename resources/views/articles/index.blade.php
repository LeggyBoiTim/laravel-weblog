@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Articles</h1>
    <table>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td><a href="{{ route('articles.show', $article) }}">View</a></td>
                    <td><a href="{{ route('articles.edit', $article->id) }}">Edit</a></td>
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