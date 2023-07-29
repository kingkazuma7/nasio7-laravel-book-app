<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    // タイトル列の登録を許可する（ホワイトリスト）
    protected $fillable = ['title'];
}
