<x-app-layout>
    <x-slot name="title">{{ $product->name }}のレビュー一覧</x-slot>

    <h1><a href="{{ route('product', $product) }}">{{ $product->name }}</a>のレビュー一覧</h1>

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
                @empty
                    <x-confirm-text>まだレビューがありません</x-confirm-text>
                @endforelse
            </div>
        </div>
    </div>

    <x-pager :items="$reviews" :align="'tac'"></x-pager>

</x-app-layout>
