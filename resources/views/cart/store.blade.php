<x-app-layout>
    <x-slot name="title">カートに追加しました</x-slot>

    <h1>カートに追加しました</h1>

    <div class="cartin-done">
        <div class="cartin-msg">
            <p><a href="{{ route('product', $new_item->product_id) }}">{{ $new_item->product->name }}</a>をカートに追加しました。</p>
            <p>数量: {{ $new_item->quantity }}</p>
        </div>
        <div class="pict-frame">
            <img src="{{ $new_item->product->img }}">
        </div>
    </div>

    <div class="cart-action">
        <x-btns>
            <a class="btn" href="{{ route('cart') }}">カートを見る</a>
        </x-btns>
        <x-btns>
            <a class="btn btn-primary-sub" href="{{ route('order') }}">購入手続きへ進む</a>
            <a class="btn btn-primary" href="{{ route('order.member') }}">会員かんたん注文へ進む</a>
        </x-btns>
    </div>

    <h2><div class="h2">一緒に購入されることの多い商品</div></h2>

    @forelse ($recommends as $product)
        @if ($loop->first) <div class="recommend-items"> @endif
        <div class="recommend-item">
            <!-- 商品画像 -->
            <div class="pict-frame"><img src="{{ $product->img }}"></div>
            <div class="data">
                <!-- 商品名 -->
                <div class="product-name"><a href="{{ route('product', $product) }}">{{ $product->name }}</a></div>
                <!-- 価格 -->
                <div class="product-price">{{ number_format($product->price) }}円</div>
            </div>
            <form class="action" method="post" action="{{ route('cart.in') }}">
                @csrf
                <!-- 数量選択 -->
                <div class="quantity">数量選択: <input type="number" name="quantity" value="1" min="1"> 個</div>
                <!-- カートに入れる -->
                <div class="recommend-cartin">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <x-form.input-submit>カートに入れる</x-form.input-submit>
                </div>
            </form>
        </div>
        @if ($loop->last) </div> @endif
    @empty
        <x-confirm-text>結果がありません</x-confirm-text>
    @endforelse

</x-app-layout>