<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
</head>
<body>
<header>
    <div class="header-inner">
        <img src="{{ asset('images/logo.png') }}" alt="COACHTECH">

        <form class="search-form" action="/" method="GET">
            <input type="text" name="keyword" placeholder="なにをお探しですか？">
        </form>

        <nav>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
            <a href="/mypage">マイページ</a>
            <a class="sell-button" href="/sell">出品</a>
        </nav>
    </div>
</header>

<main class="mypage">
    <div class="mypage__profile">
        <div class="mypage__icon"></div>

        <h2 class="mypage__name">
            {{ \App\Models\User::first()->name }}
        </h2>

        <a class="mypage__edit" href="/mypage/profile">
            プロフィールを編集
        </a>
    </div>

    <div class="mypage__tabs">
        <a class="mypage__tab mypage__tab--active" href="/mypage?page=sell">出品した商品</a>
        <a class="mypage__tab" href="/mypage?page=buy">購入した商品</a>
    </div>
</main>
</body>
</html>