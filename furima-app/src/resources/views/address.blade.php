<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>住所の変更</title>
    <link rel="stylesheet" href="{{ asset('css/address.css') }}">
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
    <div class="address-container">
        <h1 class="address-title">住所の変更</h1>

        <form action="/purchase/address/{{ $item_id }}" method="post">
            @csrf

            <div class="form-group">
                <label>郵便番号</label>
                <input type="text" name="postal_code">
            </div>

            <div class="form-group">
                <label>住所</label>
                <input type="text" name="address">
            </div>

            <div class="form-group">
                <label>建物名</label>
                <input type="text" name="building">
            </div>

            <button type="submit" class="update-btn">更新する</button>
        </form>
    </div>
</body>
</html>