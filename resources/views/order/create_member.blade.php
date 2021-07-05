<x-app-layout>
    <x-slot name="title">かんたん注文確認</x-slot>

    <h1>かんたん注文確認</h1>

    <h2><div class="h2">注文者情報</div></h2>

    <form class="form common-table" method="post" action="{{ route('order.store.member') }}">
        @csrf
        <input type="hidden" name="with_signup" value="already">
        <table>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>お名前</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>郵便番号</th>
                <td>{{ $user->postal1 }} - {{ $user->postal2 }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $user->address }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $user->tel }}</td>
            </tr>
        </table>

        <x-confirm-text>こちらの内容でお間違いありませんか？</x-confirm-text>

        <x-btns>
            <x-btn-back-cart></x-btn-back-cart>
            <x-form.input-submit>注文を確定する</x-form.input-submit>
        </x-btns>
    </form>

    <h2><div class="h2">カートの中の商品</div></h2>

    <x-cart-items-s></x-cart-items-s>

    <x-btns>
        <x-btn-back-cart></x-btn-back-cart>
    </x-btns>

</x-app-layout>