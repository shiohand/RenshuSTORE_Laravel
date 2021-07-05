<div class="cart-items-s">
    <div class="items">
        @foreach ($cart_items as $item)
            <div class="product-datas-list">
                <!-- 連番 -->
                <div class="item-index">{{ $loop->iteration }}</div>
                <!-- 商品画像 -->
                <div class="pict-frame"><img src="{{ $item->product->img }}"></div>
                <div class="datas">
                    <!-- 商品名 -->
                    <div class="data">{{ $item->product->name }}</div>
                    <!-- 価格 -->
                    <div class="data">{{ number_format($item->product->price) }}円</div>
                    <!-- 数量 -->
                    <div class="data">数量: {{ $item->quantity }}個</div>
                    <!-- 小計 -->
                    <div class="data">小計: {{ number_format($item->product->price * $item->quantity) }}円</div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="cart-totals">
        <div class="total-quantity">合計点数: {{ $total_quantity }}点
        </div>
        <div class="total-price">合計金額: {{ number_format($total_price) }}円</div>
    </div>
</div>