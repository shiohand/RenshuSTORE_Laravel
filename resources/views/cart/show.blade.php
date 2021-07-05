<x-app-layout>
    <x-slot name="title">ショッピングカート</x-slot>

    <h1>ショッピングカート</h1>

    @if ($cart_items->count())

        <div class="cart">
            <form class="form cart-view" method="post" action="{{ route('cart') }}">
                @csrf
                <x-form.input-submit>数量変更・チェックした商品の削除を実行</x-form.input-submit>

                <div class="cart-items">
                    @foreach ($cart_items as $item)
                        <div class="cart-item">
                            <div class="item-check"><input id="delete" type="checkbox" name="delete[]" value="{{$item->product_id}}"></div>
                            <!-- 商品画像 -->
                            <div class="pict-frame"><img src="{{ $item->product->img }}"></div>
                            <div class="data">
                                <!-- 商品名 -->
                                <div class="product-name"><a href="{{ route('product', $item->product->id) }}">{{ $item->product->name }}</a></div>
                                <!-- 価格 -->
                                <div class="product-price">{{ number_format($item->product->price) }}円</div>
                            </div>
                            <div class="totals">
                                <!-- 数量 -->
                                <div class="quantity">
                                    数量:
                                    <input id="quantity" type="number" name="quantity_{{ $item->product->id }}" value="{{ old('quantity_'.$item->product->id, $item->quantity) }}" min="1">個
                                    @error('quantity_'.$item->product->id) <x-form.danger>{{ $message }}</x-form.danger> @enderror
                                </div>
                                <!-- 小計 -->
                                <div class="total">小計: {{ number_format($item->product->price * $item->quantity) }}円</div>
                            </div>
                        </div>
                    @endforeach
                    <div class="cart-totals">
                        <div class="total-quantity">合計点数: {{ $total_quantity }}点</div>
                        <div class="total-price">合計金額: {{ number_format($total_price) }}円</div>
                    </div>
                </div>

                <x-form.input-submit>数量変更・チェックした商品の削除を実行</x-form.input-submit>
            </form>

            <div class="cart-action">
                <x-btns>
                    <form name="cart_clear_post" method="post" action="{{ route('cart.clear') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondory">カートを空にする</button>
                    </form>
                </x-btns>
                <x-btns>
                    <a class="btn btn-primary-sub" href="{{ route('order') }}">購入手続きへ進む</a>
                    <a class="btn btn-primary" href="{{ route('order.member') }}">会員かんたん注文へ進む</a>
                </x-btns>
            </div>
        </div>

    @else
        <x-confirm-text>現在カートに商品はありません</x-confirm-text>
    @endif

</x-app-layout>
