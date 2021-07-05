<x-app-layout>
    <x-slot name="title">ランキング</x-slot>

    <h1>ランキング</h1>

    <x-term-link :current-term="$term" :current-route="'ranking'"></x-term-link>

    @forelse ($rank_products as $product)
        @if ($loop->first) <div class="ranking-list"> @endif
        <div class="ranking-item">
            <a href="{{ route('product', $product) }}">
                <!-- ランク -->
                <div class="ranking-num"><div class="rank-badge"><span>{{ $loop->iteration }}</span></div></div>
                <!-- 商品画像 -->
                <div class="pict-frame"><img src="{{ $product->img }}"></div>
                <div class="data">
                    <!-- 商品名 -->
                    <div class="product-name">{{ $product->name }}</div>
                    <!-- 価格 -->
                    <div class="product-price tar">{{ number_format($product->price) }}円</div>
                </div>
            </a>
        </div>
        @if ($loop->last)</div> @endif
    @empty
        <x-confirm-text>結果がありません</x-confirm-text>
    @endforelse

</x-app-layout>
