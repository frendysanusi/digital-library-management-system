<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return View
     */
    public function index(Request $request)
    {
        $filter = $request->query('category_selected');
        $categories = BookCategory::all();
        
        $books = Book::when($filter, function ($query, $filter) {
            return $query->where('category_id', $filter);
        })->with('category')->orderBy('created_at', 'desc')->get();
        
        return view('books.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return View
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->file('book_file')) {
            $filePath = $request->file('book_file')->store('file', 'public');
            $validatedData['book_file'] = $filePath;
        }

        if ($request->file('cover_image')) {
            $imagePath = $request->file('cover_image')->store('images', 'public');
            $validatedData['cover_image'] = $imagePath;
        }

        Book::create($validatedData);
        return redirect()->route('books.index')->with('Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
