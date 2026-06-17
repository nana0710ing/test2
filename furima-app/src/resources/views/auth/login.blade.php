<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<header class="header">
    <img class="header__logo-img" src="{{ asset('images/logo.png') }}" alt="COACHTECH">
</header>

<div class="login-form">

    <div class="login-form__heading">
        <h1>ログイン</h1>
    </div>

    @if ($errors->any())
    <div class="error-message">
        @foreach ($errors->all() as $error)

            @if ($error === 'The email field is required.')
                <p>メールアドレスを入力してください</p>

            @elseif ($error === 'The password field is required.')
                <p>パスワードを入力してください</p>

            @elseif ($error === 'These credentials do not match our records.')
                <p>ログイン情報が登録されていません</p>

            @else
                <p>{{ $error }}</p>
            @endif

        @endforeach
</>
@endif

    <form class="form" method="POST" action="/login">
        @csrf

        <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="email">
        </div>

        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password">
        </div>

        <button type="submit">ログインする</button>

        <div class="register-link">
            <a href="/register">会員登録はこちら</a>
        </div>

    </form>

</div>

</body>
</html>