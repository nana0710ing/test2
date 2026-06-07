<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<header class="header">
    <img class="header__logo" src="{{ asset('images/logo.png') }}" alt="COACHTECH">
</header>

<div class="login-form">
    <div class="login-form__heading">
        <h1>会員登録</h1>
    </div>

    <form class="form" method="POST" action="/register">
        @csrf

        @if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
        @endif

        <div class="form-group">
            <label>ユーザー名</label>
            <input type="text" name="name">
        </div>

        <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="email">
        </div>

        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password">
        </div>

        <div class="form-group">
            <label>確認用パスワード</label>
            <input type="password" name="password_confirmation">
        </div>

        <button type="submit">登録する</button>

        <div class="register-link">
            <a href="/login">ログインはこちら</a>
        </div>
    </form>
</div>

</body>
</html>