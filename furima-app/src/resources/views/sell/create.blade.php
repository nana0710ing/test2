<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品出品</title>

    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
</head>
<body>

<header>
    <div class="header-inner">
        <h1>
            <img src="{{ asset('images/logo.png') }}" alt="COACHTECH">
        </h1>
    <form class="search-box" action="/" method="get">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="なにをお探しですか？">
    </form>
        <nav>
            @guest
                <a href="/login">ログイン</a>
            @endguest

            @auth
                <form class="logout-form" action="/logout" method="post">
                    @csrf
                    <button class="logout-button" type="submit">ログアウト</button>
                </form>
            @endauth

            <a href="/mypage">マイページ</a>
            <a href="/sell">出品</a>
        </nav>
    </div>
    </header>

<h1 class="sell-title">商品の出品</h1>

<form class="sell-form" action="/sell" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

    <h2>商品画像</h2>

    <div class="image-upload">
        <label class="image-upload__button">
            画像を選択する
            <input type="file" name="image" hidden>
        </label>
</div>

    <h2>商品の詳細</h2>

    <label>カテゴリー</label>
    <div class="category-list">
        @foreach ($categories as $category)
            <label class="category-button">
            <input type="checkbox" name="category_ids[]" value="{{ $category->id }}">
                <span>{{ $category->name }}</span>
            </label>
        @endforeach
    </div>

    <label>商品の状態</label>
    <select name="condition_id">
        <option value="">選択してください</option>
        <option value="1">良好</option>
        <option value="2">目立った傷や汚れなし</option>
        <option value="3">やや傷や汚れあり</option>
        <option value="4">状態が悪い</option>
    </select>

    <h2>商品名と説明</h2>

    <label>商品名</label>
    <input type="text" name="name">

    <label>ブランド名</label>
    <input type="text" name="brand_name">

    <label>商品の説明</label>
    <textarea name="description"></textarea>

    <label>販売価格</label>
    <div class="price-input">
        <span>¥</span>
        <input type="text" name="price">
    </div>

    <button type="submit">出品する</button>

</form>

</body>
</html>