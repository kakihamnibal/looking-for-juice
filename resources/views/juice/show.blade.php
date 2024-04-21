<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="index.css" rel="stylesheet">
    </head>
    <body>
        <div class="drink_header">
            <h1 class="drink">{{$post->first()->drink->name}}</h1>
        </div>
        <div class="post">
            <h3>
                {{$post->title}}
                <span>
                    <button class="edit" type="button" >編集</button>
                    <button class="delete" type="button" >削除</button>
                </span>
            </h3>
            <p>{{$post->body}}</p>
            <button type="button">あった</button>
            <button type="button">なかった</button>
            <p style="font-size: 10px;">{{$post->created_at}}</p>
        </div>
        <div class="back">[<a href="/drinks/{{$post->drink_id}}">戻る</a>]</div>
    </body>
</html>