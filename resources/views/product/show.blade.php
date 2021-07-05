<x-app-layout>
    <x-slot name="title">商品詳細</x-slot>

    <h1>商品詳細</h1>

    <div class="link"><a class="btn btn-round" href="{{ route('products') }}">商品一覧へ</a></div>

    <form class="product-view" method="post" action="{{ route('cart.in') }}">
        @csrf
        <div class="pict-frame"><img src="{{ $product->img }}"></div>
        <div class="datas">
            <div class="product-name">
                <p class="field-name">商品名</p>
                {{ $product->name }}
            </div>
            <div class="product-price">
                <p class="field-name">価格</p>
                {{ number_format($product->price) }}円
            </div>
            <div class="action">
                @if (strtotime($product->released_at) <= time())
                    <div class="quantity">
                        数量: <input type="number" name="quantity" value="1" min="1"> 個
                    </div>
                    <div class="product-cartin">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <x-form.input-submit>カートに入れる</x-form.input-submit>
                    </div>
                @else
                    {{ date('Y年m月d日', strtotime($product->released_at)) }} 発売予定
                @endif
            </div>
        </div>
    </form>

    <div class="product-info">
        <h2><div class="h2">商品説明</div></h2>

        <div class="product-info-body">{!! nl2br(e($product->detail)) !!}</div>
    </div>

    <div class="review-container">
        <div class="review-input">
            <h2><div class="h2">レビューを書く</div></h2>
            <div class="review-form">
                @auth
                    @if (!($is_exist))
                        <form method="post" action="{{ route('review.confirm') }}">
                            @csrf
                            <span class="announce">※1000文字以内でご入力ください</span>
                            <textarea name="body">{{ old('body') }}</textarea>
                            <x-form.input-rating></x-form.input-rating>
                            <div class="review-post">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <x-form.input-submit>確認</x-form.input-submit>
                            </div>
                        </form>
                    @else
                        <x-confirm-text>レビュー済みです</x-confirm-text>
                    @endif
                @else
                    <x-confirm-text>ログインが必要です</x-confirm-text>
                    <ul class="back-nav">
                        <li><a href="{{ route('login') }}">ログイン</a></li>
                        <li><a href="{{ route('register') }}">会員登録する</a></li>
                    </ul>
                @endauth
            </div>
        </div>

        <div class="reviews">

            <h2><div class="h2">レビュー一覧</div></h2>

            <div class="review-list">
                @forelse ($reviews as $review)
                    <div class="review-item">
                        <div class="review-data">
                            <p>会員名: {{ $review->user->name }}</p>
                            <p>評価: {{ $review->outputRating() }}</p>
                            <p>投稿日: {{ date('Y/m/d H:i:s', strtotime($review->created_at)) }}</p>
                        </div>
                        <div class="review-body">
                            {!! nl2br(e($review->body)) !!}
                        </div>
                    </div>
                    @if ($loop->last)
                        <div class="link"><a href="{{ route('product.review', $product) }}">全てのレビューを見る</a></div>
                    @endif
                @empty
                    <x-confirm-text>まだレビューがありません</x-confirm-text>
                @endforelse
            </div>
        </div>
    </div>

</x-app-layout>
