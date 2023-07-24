<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Contracts\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        // メッセージテーブルのレコードを全件取得
        $messages = Message::all();
        // dd($messages);
    
        // messagesというキーで、ビューへ渡す
        return view('message/index', ['messages' => $messages]);
    }
}
