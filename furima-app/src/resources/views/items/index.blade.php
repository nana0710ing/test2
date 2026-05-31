<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>

    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <header>
    <div class="header-inner">
        <h1>
            <img src="{{ asset('images/logo.png') }}" alt="COACHTECH">
        </h1>
    <form class="serch-box" action="/" method="get">
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
    <div class="tab">
        <a class="tab__link {{ request()->is('/') || request()->path() == '/' ? 'tab__link--active' : '' }}" href="/">おすすめ</a>

        <a class="tab__link {{ request()->is('mylist') ? 'tab__link--active' : '' }}" href="/mylist?keyword={{ request('keyword') }}">マイリスト</a>
    </div>
    <main>

        <div class="item-list">
            @foreach ($items as $item)
            <div class="item">
                <a href="/item/{{ $item->id }}">
                    <img src="{{ $item->img_url }}" alt="{{ $item->name }}" width="200">

                    @if($item->purchase)
                        <p>Sold</p>
                    @endif
                </a>
                <p>{{ $item->name }}</p>
            </div>
            @endforeach
        </div>
</main>

</body>
</html>