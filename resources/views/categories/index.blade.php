@extends('layouts.app')

@section('title', $title)

@section('content')
    <h1>My Categories</h1>
    <form action="{{ route('categories.store') }}" method="POST" style="display: inline;">
        @csrf
        <label for="name">New Category:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Add</button>
    </form>
    <div style="width: 25%; height: fit content; display: flex; flex-wrap: wrap; margin-top: 0.5em;">
        @forelse ($sortedCategories as $category)
            <div style="float: left; border: 2px solid #555; border-radius: 1em; background-color: #ddd; width:fit-content; height: 1em; padding: 0.5em; margin-right: 0.5em; margin-top: 0.5em; font-weight: bold;">
                {{ $category->name }}
            </div>
        @empty
            <p>No categories found.</p>
        @endforelse
    </div>
@endsection