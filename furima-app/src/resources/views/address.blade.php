<h1>住所の変更</h1>

<form action="/purchase/address/{{ $item_id }}" method="post">
    @csrf
    <p>郵便番号</p>
    <input type="text" name="postal_code">

    <p>住所</p>
    <input type="text" name="address">

    <p>建物名</p>
    <input type="text" name="building">

    <button type="submit">更新する</button>
</form>