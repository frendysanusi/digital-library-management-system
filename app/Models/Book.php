<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'description',
        'stock',
        'book_file',
        'cover_image'
    ];

    public function category() {
        return $this->belongsTo(BookCategory::class, 'category_id', 'id');
    }
}
