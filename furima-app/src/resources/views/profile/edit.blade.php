<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール設定</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
                @auth
                    <form class="logout-form" action="/logout" method="post">
                        @csrf
                        <button class="logout-button" type="submit">ログアウト</button>
            </form>
                @endauth

                <a href="/mypage">マイページ</a>
                <a class="sell-button" href="/sell">出品</a>
            </nav>
        </div>
    </header>

    <div class="profile">
        <h2 class="profile__title">プロフィール設定</h2>

        <form class="profile-form" action="/mypage/profile" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-form__image">
                <div class="profile-form__circle">
                    @if(auth()->user()->image)
                        <img src="{{ asset(auth()->user()->image) }}" alt="プロフィール画像">
                    @endif
                </div>
                <label class="profile-form__button">
                    画像を選択する
                <input type="file" name="image" hidden>
                </label>
            </div>

            <div class="profile-form__group">
                <label>ユーザー名</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}">
            </div>

            <div class="profile-form__group">
                <label>郵便番号</label>
                <input type="text" name="postal_code" value="{{ auth()->user()->postal_code }}">
            </div>

            <div class="profile-form__group">
                <label>住所</label>
                <input type="text" name="address" value="{{ auth()->user()->address }}">
            </div>

            <div class="profile-form__group">
                <label>建物名</label>
                <input type="text" name="building" value="{{ auth()->user()->building }}">
            </div>

            <button class="profile-form__submit">更新する</button>
        </form>
    </div>
</body>
</html>