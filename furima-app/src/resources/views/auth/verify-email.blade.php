<h1>メール認証</h1>

<p>登録したメールアドレスに認証メールを送信しました。</p>
<p>メール内のリンクをクリックして認証を完了してください。</p>

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">認証メールを再送する</button>
</form>