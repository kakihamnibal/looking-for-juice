<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <x-noLogin>
            <x-slot name="header">
                ジュース発見ブログ&emsp;&emsp;
                <a href='/login' class='transition hover:opacity-40'>ログイン</a>&nbsp;/&nbsp;
                <a href='/register' class='transition hover:opacity-40'>新規登録</a>
            </x-slot>
            <h1>飲み物発見ブログ</h1>
            <button class="create" type="button" ><a href="/drinks/create">投稿</a></button>
            @foreach($drinks as $drink)
            <div class="drink_list">
                <h3 class="drink"><a href='/drinks/{{$drink->id}}'>{{$drink->name}}</h3>
            </div>
            @endforeach
        </x-noLogin>
    </body>
</html>