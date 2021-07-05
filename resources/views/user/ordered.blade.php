<x-app-layout>
    <x-slot name="title">注文履歴</x-slot>

    <h1>注文履歴</h1>

    <x-term-link :current-term="$term" :current-route="'user.ordered'"></x-term-link>

    <x-pager :items="$orders"></x-pager>

    <div class="ordered-view">
        @forelse ($orders as $order)

            <div class="ordered-products">
                <div class="ordered-title">
                    <div class="ordered-date">
                        注文日時: {{ date('Y/m/d H:i:s', strtotime($order->created_at)) }}
                    </div>
                    <div class="ordered-totalprice">
                        合計金額: {{ number_format($order->getTotalPrice()) }}円
                    </div>
                </div>

                @foreach ($order->order_details as $order_detail)

                    <div class="product-datas-list">
                        <!-- 商品画像 -->
                        <div class="pict-frame"><img src="{{ $order_detail->product->img }}"></div>
                        <div class="datas">
                            <!-- 商品名 -->
                            <div class="data"><a href="{{ route('product', $order_detail->product) }}">{{ $order_detail->product->name }}</a></div>
                            <!-- 価格 -->
                            <div class="data">{{ number_format($order_detail->price) }}円</div>
                            <!-- 数量 -->
                            <div class="data">数量: {{ $order_detail->quantity }}個</div>
                            <!-- 小計 -->
                            <div class="data">小計: {{ number_format($order_detail->price * $order_detail->quantity) }}円</div>
                        </div>
                    </div>

                @endforeach
            </div>

        @empty
            <x-confirm-text>該当なし</x-confirm-text>
        @endforelse
    </div>

    <x-pager :items="$orders"></x-pager>

</x-app-layout>