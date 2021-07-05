<x-app-layout>
    <x-slot name="title">トップページ</x-slot>

    <h1>トップページ</h1>

    <div class="top-links tac">
        <div class="product tal"><a href="{{ route('products') }}">商品一覧へ</a></div>
        <div class="ranking tal"><a href="{{ route('ranking') }}">ランキングへ</a></div>
    </div>

    <!-- ランキング -->
    <h2><div class="h2 h2-top">ランキング(月間売上額)</div></h2>

    <div class="link link-top"><a class="btn btn-round" href="{{ route('ranking') }}">ランキングの続きへ</a></div>

    <div class="ranking-top scroll">
        <!-- 横スクロール -->
        @forelse ($rank_products as $product)
            @if ($loop->first) <div class="top-list"> @endif
                <div class="top-list-item">
                    <a href="{{ route('product', $product) }}">
                        <!-- ランク --><div class="ranking-num"><div class="rank-badge"><span>{{ $loop->iteration }}</span></div></div>
                        <!-- 商品画像 --><div class="pict-frame"><img src="{{ $product->img }}"></div>
                        <div class="data">
                            <!-- 商品名 --><div class="product-name">{{ $product->name }}</div>
                            <!-- 価格 --><div class="product-price tar">{{ number_format($product->price) }}円</div>
                        </div>
                    </a>
                </div>
            @if ($loop->last) </div> @endif
        @empty
            <x-confirm-text>結果がありません</x-confirm-text>
        @endforelse
    </div>

    <div class="link link-top"><a class="btn btn-round" href="{{ route('ranking') }}">ランキングの続きへ</a></div>

    <!-- 新着商品 -->

    <h2><div class="h2 h2-top">新着商品</div></h2>

    <div class="link link-top"><a class="btn btn-round" href="{{ route('products') }}">商品一覧へ</a></div>

    <div class="product-top scroll">
        <!-- 横スクロール -->
        @forelse ($new_products as $product)
            @if ($loop->first) <div class="top-list"> @endif
                <div class="top-list-item">
                    <a href="{{ route('product', $product) }}">
                        <!-- 商品画像 --><div class="pict-frame"><img src="{{ $product->img }}"></div>
                        <div class="data">
                            <!-- 商品名 --><div class="product-name">{{ $product->name }}</div>
                            <!-- 価格 --><div class="product-price tar">{{ number_format($product->price) }}円</div>
                        </div>
                    </a>
                </div>
            @if ($loop->last) </div> @endif
        @empty
            <x-confirm-text>結果がありません</x-confirm-text>
        @endforelse
    </div>

    <div class="link link-top"><a class="btn btn-round" href="{{ route('products') }}">商品一覧へ</a></div>


    <!-- 発売予定 -->
    <h2><div class="h2 h2-top">発売予定</div></h2>

    <div class="product-top scroll">
        <!-- 横スクロール -->
        @forelse ($future_products as $product)
            @if ($loop->first) <div class="top-list"> @endif
                <div class="top-list-item">
                    <a href="{{ route('product', $product) }}">
                        <!-- 商品画像 --><div class="pict-frame"><img src="{{ $product->img }}"></div>
                        <div class="data">
                            <!-- 商品名 --><div class="product-name">{{ $product->name }}</div>
                            <!-- 発売日 --><div class="product-release tar">{{ date('Y年m月d日', strtotime($product->relesed_at)) }}</div>
                        </div>
                    </a>
                </div>
            @if ($loop->last) </div> @endif
        @empty
            <x-confirm-text>結果がありません</x-confirm-text>
        @endforelse
    </div>

</x-app-layout>
