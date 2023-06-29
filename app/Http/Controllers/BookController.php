<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Books/Index', [
            'books' => Book::with('categories')->get(),
            'categories' => category::all(),
        ]);
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
    public function store(Request $request)
    {
        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'user_id' => auth()->id(),
        ]);

        $book->categories()->attach($request->category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        if (!auth()->user()->books->contains($book)) {
            abort(403);
        }
        $book->update([
            'title' => $request->title,
            'year' => $request->year,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if (!auth()->user()->books->contains($book)) {
            abort(403);
        }
        $Book->delete();
    }

    public function addCategory(Request $request, Book $book, Category $cat)
    {
        if (!auth()->user()->books->contains($book)) {
            abort(403);
        }
        $book->categories()->attach($cat->id);
    }

    public function removeCategory(Request $request, Book $book, Category $category)
    {
        if (!auth()->user()->books->contains($book)) {
            abort(403);
        }
        $book->category()->detach($category->id);
    }
}
