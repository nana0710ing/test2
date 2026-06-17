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
        <div class="mypage__icon">
        @if(optional(auth()->user())->image)
            <img src="{{ asset(auth()->user()->image) }}" alt="プロフィール画像">
        @endif
        </div>

        <h2 class="mypage__name">
            {{ optional(auth()->user())->name ?? 'ユーザー名未設定' }}
        </h2>

        <a class="mypage__edit" href="/mypage/profile">
            プロフィールを編集
        </a>
    </div>

    <div class="mypage__tabs">
        <a class="mypage__tab {{ request('page') !== 'buy' ? 'mypage__tab--active' : '' }}" href="/mypage?page=sell">出品した商品</a>

        <a class="mypage__tab {{ request('page') === 'buy' ? 'mypage__tab--active' : '' }}" href="/mypage?page=buy">購入した商品</a>
    </div>

    @if(request('page') !== 'buy')
    <div class="item-list">
        @foreach(\App\Models\Item::where('user_id', auth()->id())->get() as $item)
            <div class="item-card">
                <a href="/item/{{ $item->id }}">
                <img
                    src="{{ asset($item->img_url) }}"
                    style="width:200px; height:200px; object-fit:cover;"
>
                <p>{{ $item->name }}</p>
                </a>
            </div>
        @endforeach
        </div>
    @endif

    @if(request('page') === 'buy')
    <div class="item-list">
        @foreach(\App\Models\Purchase::where('user_id', auth()->id())->get() as $purchase)
        <div class="item-card">
            <a href="/item/{{ $purchase->item->id }}">
            <img
                src="{{ asset($purchase->item->img_url) }}"
                style="width:200px; height:200px; object-fit:cover;"
>
            <p>{{ $purchase->item->name }}</p>
            </a>
        </div>
        @endforeach
        </div>
    @endif
</main>
</body>
</html>