<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('/js/discovery.js')}}"></script>
    </head>
    <body>
        <x-noLogin>
            <x-slot name="header">
                ジュース発見ブログ&emsp;&emsp;
                <a href='/login'>ログイン</a>&nbsp;/&nbsp;<a href='/register'>新規登録</a>
            </x-slot>
            <div class="drink_header">
                    <h1 class="drink">{{$post->drink->name}}</h1>
            </div>
            <div class="posts">
                <h3>
                    {{$post->title}}
                    <span>
                        <button class="edit" type="button" >編集</button>
                        <button class="delete" type="button" >削除</button>
                    </span>
                </h3>
                <p>{{$post->prefecture->prefecture}}{{$post->city->city}}</p>
                <p>{{$post->body}}</p>
                <button onclick="discovery({{$post->id}})">あった</button>
                @foreach($discovery_counts as $discovery_count)
                    <div>{{$discovery_count->discoveries_count}}</div>
                @endforeach
                <button onclick="cancelDiscover({{$post->id}})">あった解除</button>
                <p style="font-size: 10px;">{{$post->created_at}}</p>
            </div>
            <div class="back">[<a href="/drinks/{{$post->drink_id}}">戻る</a>]</div>
        </x-noLogin> 
    </body>
</html>
    