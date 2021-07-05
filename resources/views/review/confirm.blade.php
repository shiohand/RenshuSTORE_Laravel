<x-app-layout>
    <x-slot name="title">レビュー投稿確認</x-slot>

    <h1>レビュー投稿確認</h1>

    <form class="form" method="post" action="{{ route('review.store') }}">
        @csrf
        <div class="review-check">

            <x-confirm-text><a href="{{ route('product', $product) }}">{{ $product->name }}</a>のレビューを投稿</x-confirm-text>
            
            <div class="review">
                <div class="data">
                    評価: {{ $review->outputRating() }}
                    <input type="hidden" name="rating" value="{{ request()->rating }}">
                </div>
                <div class="data">
                    レビュー本文: <div class="body">{!! nl2br(e($review->body)) !!}</div>
                    <input type="hidden" name="body" value="{{ request()->body }}">
                </div>
            </div>

        </div>

        <x-confirm-text>この内容でレビューを投稿します。よろしいですか？</x-confirm-text>

        <x-btns>
            <x-btn-back />
            <input type="hidden" name="product_id" value="{{ request()->product_id }}">
            <x-form.input-submit>投稿</x-form.input-submit>
        </x-btns>
    </form>

</x-app-layout>