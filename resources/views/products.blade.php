<x-app-layout>
    <x-slot name="title">商品一覧</x-slot>

    <h1>商品一覧</h1>

    <x-sort-link :current="$sort"></x-sort-link>

    @forelse ($products as $product)
        @if ($loop->first) <ul class="product-list"> @endif
        <li class="product-item">
            <a href="{{ route('product', $product) }}">
                <!-- 商品画像 -->
                <div class="pict-frame"><img src="{{ $product->img }}"></div>
                <div class="data">
                    <!-- 商品名 --><div class="product-name">{{ $product->name }}</div>
                    <!-- 価格 --><div class="product-price tar">{{ number_format($product->price) }}円</div>
                </div>
            </a>
        </li>
        @if ($loop->last) </ul> @endif
    @empty
        <x-confirm-text>結果がありません</x-confirm-text>
    @endforelse

    <x-pager :items="$products" :align="'tac'"></x-pager>

</x-app-layout>
