<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
    <title>メール認証</title>
</head>
<body>
    <header class="header">
        <img class="header__logo-img" src="{{ asset('images/logo.png') }}" alt="COACHTECH">
    </header>

    <main class="verify">
        <div class="verify__content">
            <p>
                登録していただいたメールアドレスに認証メールを送付しました。<br>
                メール認証を完了してください。
            </p>

            <a href="http://localhost:8025" class="verify__button">
                認証はこちらから
            </a>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="verify__resend">
                    認証メールを再送する
                </button>
            </form>
        </div>
    </main>
</body>
</html>