<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function index(): Collection
    {
        // 書籍一覧を取得
        $books = Book::all();
        return $books;
    }
    
    public function show(string $id): Book
    {
        // 書籍を一件取得
        $book = Book::findOrfail($id);
        return $book;
    }
    
}
