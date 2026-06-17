<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">

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

<div class="purchase">
<div class="purchase__left">

<div class="purchase__item">
    <img src="{{ asset($item->img_url) }}" alt="{{ $item->name }}">

    <div>
        <p>{{ $item->name }}</p>
        <p>¥{{ number_format($item->price) }}</p>
    </div>
</div>

<hr>

<form action="{{ route('purchase.store', $item->id) }}" method="POST">
    @csrf

<p>支払い方法</p>
<select name="payment_method">
    <option value="">選択してください</option>
    <option value="convenience">コンビニ払い</option>
    <option value="card">カード支払い</option>
</select>
<hr>

@if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="address-header">
    <p>配送先</p>

    <a href="/purchase/address/{{ $item->id }}">
        変更する
    </a>
</div>
<hr>

<p>〒{{ $user->postal_code }}</p>
<p>{{ $user->address }}</p>

@if($user->building)
    <p>{{ $user->building }}</p>
@endif

</div>

<div class="purchase__right">
    <div class="purchase-summary">
        <div class="purchase-summary__row">
            <span>商品代金</span>
            <span>￥{{ number_format($item->price) }}</span>
        </div>
        <div class="purchase-summary__row">
            <span>支払い方法</span>
            <span id="paymentText">選択してください</span>
        </div>
    </div>

    <button class="purchase__button" type="submit">購入する</button>
</div>

</form>

</div>
</div>

<script>
    const select = document.querySelector('select[name="payment_method"]');
    const paymentText = document.getElementById('paymentText');

    select.addEventListener('change', function () {
        if (this.value === 'convenience') {
            paymentText.textContent = 'コンビニ払い';
        } else if (this.value === 'card') {
            paymentText.textContent = 'カード支払い';
        } else {
            paymentText.textContent = '選択してください';
        }
    });
</script>