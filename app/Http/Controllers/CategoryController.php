<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource belonging to the user.
     */
    public function myCategories()
    {
        $categories = Auth::user()->categories;
        $sortedCategories = $categories->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
        return view('categories.index', compact('sortedCategories'), ['title' => 'My Categories']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
            Category::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        return redirect()->route('categories.my-categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $articles = $category->articles;
        $sortedArticles = $articles->sortByDesc('created_at');
        $categories = Category::all();
        $sortedCategories = $categories->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
        return view('articles.index', ['title' => 'Articles with the category: ' . $category->name], compact('sortedArticles', 'sortedCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.my-categories');
    }
}
