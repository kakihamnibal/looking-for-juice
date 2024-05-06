<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
                ジュース発見ブログ
            </x-slot>
            <h1>編集</h1>
            <form action='/posts/{{$post->id}}' method="POST">
                @csrf
                @method('PUT')
                <div class="title">
                    <h2>投稿文の編集</h2>
                    <input type="text" name="post[title]" value="{{$post->title}}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
                </div>
                <div class="body">
                    <h2>本文</h2>
                    <textarea name="post[body]" placeholder="オランジーナを発見したぞ！">{{$post->body}}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                </div>
                <div class="prefecture">
                    <select name='post[prefecture_id]' id='prefecture_select'>
                        <option>都道府県を選択してください</option>
                        @foreach($prefectures as $prefecture)
                            <option value='{{ $prefecture->id }}' id='{{ $prefecture->id }}'>{{ $prefecture->prefecture }}</option>
                        @endforeach
                    </select>
                </div>
                <div class='city'>
                    <select name='post[city_id]' id='city_select'>
                        <option>市区町村を選択してください</option>
                    </select>
                </div>
                <br>
                <input type="submit" value="投稿">
            </form>
            <div class="back">[<a href="/">戻る</a>]</div>
        </x-app-layout> 
        <script>
            const prefectureSelect = document.getElementById('prefecture_select');
            const citySelect = document.getElementById('city_select');
        
            // 都道府県が変更されたときに呼び出される関数
            function updateCities() {
                // 選択された都道府県の値（value）を取得
                const selectedPrefecture = prefectureSelect.value;
        
                // 市区町村の選択肢を空にする->例）北海道から沖縄に変更した時にリセットするため
                citySelect.innerHTML = '';
        
                // 選択された都道府県に対応する市区町村の選択肢を表示
                @foreach($cities as $city)
                    if ('{{ $city->prefecture_id }}' === selectedPrefecture) {
                        //createElement（'option'）はhtml要素を作るためのメソッド
                        const option = document.createElement('option');
                        option.value = '{{ $city->id }}';
                        option.textContent = '{{ $city->city }}';
                        //citySelectに上で作ったoption要素を追加している
                        citySelect.appendChild(option);
                    }
                @endforeach
            }
        
            // 都道府県が変更されたときにupdateCities関数を呼び出す
            prefectureSelect.addEventListener('change', updateCities);
            
            // 初期表示時に市区町村の選択肢を更新
            //質問
            updateCities();
        </script>
    </body>
</html>