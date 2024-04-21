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
                <a href='/posts/{{$post->id}}'>{{$post->title}}</a>
                <span>
                    <button class="edit" type="button" ><a href='/posts/{{$post->id}}/edit'>編集</a></button>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="delete" type="button" onclick="deletePost({{ $post->id }})">削除</button> 
                    </form>
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
        <script>
            function deletePost(id) {
             'use strict'

             if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
            }
        }
        </script>
    </body>
</html>