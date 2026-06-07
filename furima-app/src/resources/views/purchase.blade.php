<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">

<div class="purchase">
<div class="purchase__left">

<h1>購入画面</h1>

<p>{{ $item->name }}</p>

<p>¥{{ number_format($item->price) }}</p>

<img src="{{ asset($item->img_url) }}" alt="{{ $item->name }}" width="200">

<form action="{{ route('purchase.store', $item->id) }}" method="POST">
    @csrf

<p>支払い方法</p>
<select name="payment_method">
    <option value="">選択してください</option>
    <option value="convenience">コンビニ払い</option>
    <option value="card">カード支払い</option>
</select>

@if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<p>
    配送先
    <a href="/purchase/address/{{ $item->id }}">変更する</a>
</p>

<p>〒{{ $user->postal_code ?? '123-4567' }}</p>

<p>{{ $user->address ?? '東京都渋谷区〇〇1-2-3' }}</p>

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