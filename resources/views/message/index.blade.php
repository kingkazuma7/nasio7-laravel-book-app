<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="antialiased">
        <main>
            <h1>メッセージ</h1>
            <form action="/messages" method="POST">
                @csrf
                <input type="text" name="body">
                <input type="submit" value="投稿">
            </form>
            <ul>
                @foreach ($messages as $message)
                    <li>{{ $message->body }}</li>
                @endforeach
            </ul>
        </main>
    </body>
</html>
