<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>投稿</h1>
        <form action="/drinks" method="POST">
            @csrf
            <div class="title">
                <h2>投稿文の作成</h2>
                <input type="text" name="post[title]" placeholder="タイトル（場所の名前など）" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="オランジーナを発見したぞ！">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="prefecture">
                <select name="prefectures" size="1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="drink">
                <h3>見つけたジュース</h3>
                <select name="post[drink_id]">
                    @foreach($drinks as $drink)
                        <option value="{{ $drink->id }}">{{ $drink->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <input type="submit" value="投稿">
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
    </body>
</html>