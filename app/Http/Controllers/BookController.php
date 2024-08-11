<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        
        $user = Auth::user();
        $user_role = $user->role;

        $booksQ = Book::when($filter, function ($query, $filter) {
            return $query->where('category_id', $filter);
        })->with('category')->orderBy('created_at', 'desc');

        if ($user_role !== 'admin') {
            $booksQ->whereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $books = $booksQ->get();
        
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

        $book = Book::create($validatedData);

        $user = Auth::user();
        $book->users()->attach($user->id);

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
        $validatedData = $request->validated();

        if ($request->file('book_file')) {
            $filePath = $request->file('book_file')->store('file', 'public');
            $validatedData['book_file'] = $filePath;
        }

        if ($request->file('cover_image')) {
            $imagePath = $request->file('cover_image')->store('images', 'public');
            $validatedData['cover_image'] = $imagePath;
        }

        $book->update($validatedData);
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

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }
}
