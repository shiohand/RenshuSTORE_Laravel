<x-app-layout>
    <x-slot name="title">レビュー履歴</x-slot>

    <h1>レビュー履歴</h1>

    @forelse ($reviews as $review)
        @if ($loop->first) <div class="reviews"> @endif
            <div class="review">
                <div class="data">商品名: {{ $review->product->name }}</div>
                <div class="data">評価: {{ $review->outputRating() }}</div>
                <div class="data">本文: <div class="body">{!! nl2br(e($review->body)) !!}</div></div>
                <div class="data">投稿日: {{ date('Y/m/d H:i:s', strtotime($review->created_at)) }}</div>
            </div>
        @if ($loop->last) </div> @endif
    @empty
        <x-confirm-text>まだレビューがありません</x-confirm-text>
    @endforelse

    <x-pager :items="$reviews"></x-pager>

</x-app-layout>