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
            <h1 class="drink">{{$posts->first()->drink->name}}</h1>
        </div>
        @foreach($posts as $post)
        <div class="posts">
            <h3>
                {{$post->title}}
                <span>
                    <button class="edit" type="button" >編集</button>
                    <button class="delete" type="button" >削除</button>
                </span>
            </h3>
            <button type="button">あった</button>
            <button type="button">なかった</button>
            <p style="font-size: 10px;">{{$post->created_at}}</p>
        </div>
        @endforeach
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
    </body>
</html>