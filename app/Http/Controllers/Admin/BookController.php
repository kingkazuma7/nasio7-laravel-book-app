<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

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
    
    public function create(): View
    {
        // ビューにカテゴリ一覧を表示するために全件取得
        $categories = Category::all();
        
        // ビューオブジェクトを返す
        return view('admin/book/create', [
            'categories' => $categories
        ]);
    }
    
    public function store(Request $request): Book
    {
        // 書籍データ登録用のオブジェクトを作成する
        $book = new Book();
        
        // リクエストオブジェクトからパラメータを取得
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;
        
        // 保存
        $book->save();
        
        // 登録完了後book.indexにリダイレクトする
        return $book;
    }
}
