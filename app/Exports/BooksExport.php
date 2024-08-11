<?php

namespace App\Exports;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()->role === 'admin') {
            return Book::select('books.id', 'title', 'book_categories.name as category', 'books.description', 'books.stock', 'books.book_file', 'books.cover_image')
                ->join('book_categories', 'book_categories.id', '=', 'books.category_id')
                ->orderBy('books.id')
                ->get();
        }
        else {
            return Book::select('books.id', 'title', 'book_categories.name as category', 'books.description', 'books.stock', 'books.book_file', 'books.cover_image')
                ->join('book_categories', 'book_categories.id', '=', 'books.category_id')
                ->join('book_user', 'books.id', '=', 'book_user.book_id')
                ->where('book_user.user_id', Auth::user()->id)
                ->orderBy('books.id')
                ->get();
        }
    }

    /**
     * @return array
     */
    public function headings(): array {
        return [
            'ID',
            'Judul',
            'Kategori',
            'Deskripsi',
            'Jumlah',
            'File',
            'Cover Buku',
        ];
    }
}
