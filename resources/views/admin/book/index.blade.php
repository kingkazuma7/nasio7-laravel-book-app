<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>書籍一覧</title>
</head>
<body>
    <main>
        <h1>書籍一覧</h1>
        @if (session('message'))
            <div style="color:blue">
                {{ session('message') }}
            </div>
        @endif
        <a href="{{ route('book.create') }}">追加</a>
        <x-book-table :$books />
        {{-- <table border="1">
            <tr>
                <th>カテゴリ</th>
                <th>書籍名</th>
                <th>価格</th>
            </tr>
            @foreach ($books as $book)
                <tr @if ($loop->even) style="background-color:#E0E0E0" @endif></tr>
                    <td>{{ $book->category->title }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->price }}</td>
                </tr>
            @endforeach
        </table> --}}
    </main>
</body>
</html>