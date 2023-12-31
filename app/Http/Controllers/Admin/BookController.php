<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Http\Requests\BookPutRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        // 書籍一覧を取得
        $books = Book::all();
        
        // 書籍一覧をレスポンスとして返す
        return view('admin/book/index', ['books' => $books]);
        
         // 書籍一覧を取得
        $books = Book::with('category')
            ->orderBy('category_id')
            ->orderBy('title')
            ->get();
            
        return response()
            ->view('admin/book/index', ['books' => $books])
            ->header('Content-Type', 'text/html')
            ->header('Content-Encoding', 'UTF-8');
    }
    
    public function show(Book $book): View
    {
        // 書籍を一件取得
        // $book = Book::findOrfail($id);
        
        return view('admin/book/show', compact('book'));
    }
    
    public function create(): View
    {
        // ビューにカテゴリ一覧を表示するために全件取得
        $categories = Category::all();
        
        // 著者一覧を表示するために全件取得
        $authors = Author::all();
        
        // ビューオブジェクトを返す
        return view('admin/book/create',
                compact('categories', 'authors'));
    }
    
    public function store(BookPostRequest $request): RedirectResponse
    {
        // 書籍データ登録用のオブジェクトを作成する
        $book = new Book();
        
        // リクエストオブジェクトからパラメータを取得
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;
        
        DB::transaction(function () use($book, $request) {
            // 保存
            $book->save();
            
            // 著者書籍テーブルを登録
            $book->authors()->attach($request->author_ids);
        });
        
        
        // 登録完了後book.indexにリダイレクト
        return redirect(route('book.index'))
        ->with('message', $book->title . 'を追加しました。');
    }
    
    public function edit(Book $book): View
    {
        // カテゴリ一覧を表示するために全件取得
        $categories = Category::all();
        
        // 著者一覧を表示するために全件取得
        $authors = Author::all();
        
        // 書籍に紐づく著者IDの一覧を取得
        $authorIds = $book->authors()->pluck('id')->all();
        
        return view('admin/book/edit',
                compact('book', 'categories', 'authors', 'authorIds'));
    }
    
    public function update(BookPutRequest $request, Book $book): RedirectResponse
    {
        // リクエストオブジェクトからパラメータを取得する
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;
        
        DB::transaction(function() use($book, $request) {
            // 更新
            $book->update();
            
            // 書籍と著者の関連付けを更新する
            $book->authors()->sync($request->author_ids);
        });
        
        return redirect(route('book.index'))
                ->with('message', $book->title . 'を変更しました。');
    }
    
    public function destory(Book $book): RedirectResponse
    {
        // 2023_07_29_011152_create_author_book_table.phpでcascadeOnDelete追加
        //  → bookid削除で著者書籍レコードも削除される
        // DB::transaction(function () use($book) {
        //     // 削除
        //     $book->authors()->detach();
        //     $book->delete();
        // });
        
        // 削除
        $book->delete();
        
        return redirect(route('book.index'))
                ->with('message', $book->title . 'を削除しました。');
    }
}
