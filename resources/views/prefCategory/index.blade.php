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
                ジュース発見ブログ&emsp;&emsp;
                <a href='/login' class='transition hover:opacity-40'>ログイン</a>&nbsp;/&nbsp;
                <a href='/register' class='transition hover:opacity-40'>新規登録</a>
            </x-slot>
            
            <div class="drink_header">
                <h1 class="text-blue-600">{{$drink->name}}</h1>
            </div>
             <div class="prefecture_header">
                <h1>{{ $prefName->prefecture }}</h1>
            </div>
            <select id='prefecture_id'>
                <option>都道府県</option>
                @foreach($prefectures as $prefecture)
                    <option value='{{ $prefecture->id }}'>{{ $prefecture->prefecture }}</option>
                @endforeach
            </select>
            <button type='button' onclick="location.href='/drink/{{ $drink->id }}/prefecture/' + document.getElementById('prefecture_id').value;">絞り込み</button>
            <!--getElementByIdでoptionのvalueを取得し、それをURIに含めることでlocationメソッドを使いprefCategoryのindexのページに飛ぶことができる --> 
            @if(session('success'))
            	<div>
            		{{ session('success') }}
            	</div>
            @endif
            
            @if(session('failure'))
            	<div>
            		{{ session('failure') }}
            	</div>
            @endif
            @foreach($posts as $post)
            <div class="posts">
                <h3>
                    <a href='/posts/{{ $post->id }}'>{{ $post->title }}</a>
                    <table class='text-white'>
                        <tr>
                            <td>@if( $userId == $post->id )<button class="bg-teal-500" type="button" ><a href='/posts/{{$post->id}}/edit'>編集</a></button>@endif</td>
                            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <td><button class="bg-red-500" type="button" onclick="deletePost({{ $post->id }})">削除</button></td>
                            </form>
                        </tr>
                    </table>
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
                    //formタグの内容を取得し送信
                }
            }
        </script>
    </body>
</html>