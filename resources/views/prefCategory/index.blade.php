<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
    </head> 
    <body>
        <x-noLogin>
            <x-slot name="header">
                ジュース発見ブログ
            </x-slot>
            
            <div class="drink_header">
                <h1 class="drink">{{$drink->name}}</h1>
            </div>
            <form action='/prefecture/{{$prefectureId}}' method="get">
                <label for="prefecture">都道府県:</label>
                <select name="prefecture_id" id="prefecture">
                    <option value="">すべて</option>
                    @foreach($prefectures as $prefecture)
                        <option value="{{$prefecture->id}}">{{$prefecture->prefecture}}</option>
                    @endforeach
                </select>
                <button type="submit">絞り込む</button>
            </form>
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
                <p>{{$post->prefecture->prefecture}}{{$post->city->city}}</p>
                <p style="font-size: 10px;">{{$post->created_at}}</p>
            </div>
            @endforeach
            <div class='paginate'>
                {{ $posts->links() }}
            </div>
        </x-noLogin>  
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