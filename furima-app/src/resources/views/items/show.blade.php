<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/show.css') }}">

<header>
    <div class="header-inner">

        <h1>
            <img src="{{ asset('images/logo.png') }}" alt="COACHTECH">
        </h1>
    <div class="serch-box">
        <input type="text" placeholder="なにをお探しですか？">
    </div>
        <nav>
            <a href="#">ログイン</a>
            <a href="#">マイページ</a>
            <a href="#">出品</a>
        </nav>
    </div>
    </header>

<div class="detail">

    <div class="detail__image">
        <img src="{{ asset($item->img_url) }}" alt="{{ $item->name }}" width="400">
    </div>

    <div class="detail__content">
        <h1>{{ $item->name }}</h1>

        <p>ブランド名</p>
        <p>{{ $item->brand_name ?? '' }}</p>

        <h2>¥{{ number_format($item->price) }} <span>(税込)</span></h2>

        <div class="detail__icon">

            <div class="icon">
                <form action="/like/{{ $item->id }}" method="post">
                    @csrf
                    <button type="submit" class="favorite-button">

                    @if($item->likes->where('user_id', 1)->count())
                        <img src="{{ asset('images/heart.pink.png') }}" alt="">
                    @else
                        <img src="{{ asset('images/heart.png') }}" alt="">
                    @endif

                    </button>
                </form>
                <p>{{ $item->likes->count() }}</p>
            </div>

            <div class="icon">
                <img src="{{ asset('images/comment.png') }}" alt="">
                <p>{{ $item->comments->count() }}</p>
            </div>

        </div>

        @if($item->purchase)
            <p>Sold</p>
        @else
            <a href="/purchase/{{ $item->id }}" class="purchase-button">
                購入手続きへ
            </a>
        @endif

        <h3>商品説明</h3>

        {{ $item->description }}

        <h3>商品の情報</h3>

        <div class="info">
            <p>カテゴリー</p>
            @foreach ($item->categories as $category)
                <span>{{ $category->name }}</span>
            @endforeach
        </div>

        <div class="info">
            <p>商品の状態</p>
            <p>良好</p>
        </div>

        <h3>コメント({{ $item->comments->count() }})</h3>

        @foreach($item->comments as $comment)

        <div class="comment-user">
            <div class="user-icon"></div>
            <p>{{ $comment->user->name }}</p>
        </div>

        <div class="comment-box">
            {{ $comment->comment }}
        </div>
        @endforeach

        <h3>商品へのコメント</h3>

    <form action="/comment/{{ $item->id }}" method="post">
        @csrf

        @error('comment')
        <p style="color:red;">
            {{ $message }}
        </p>
        @enderror
        <textarea name="comment"></textarea>

        <button class="comment-button">
            コメントを送信する
        </button>
    </form>

    </div>

</div>