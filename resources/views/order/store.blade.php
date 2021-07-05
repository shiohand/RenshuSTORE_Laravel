<x-app-layout>
    <x-slot name="title">注文完了</x-slot>

    <h1>注文完了</h1>

    <x-confirm-text>
        {{ $order->name }} 様<br>
        ご注文ありがとうございました<br>
        {{ $order->email }} にメールを送りましたのでご確認ください<br>
        商品は以下の住所に発送させていただきます<br>
        {{ $order->postal1 }}-{{ $order->postal2 }}<br>
        {{ $order->address }}<br>
        お客様の電話番号: {{ $order->tel }}
    </x-confirm-text>

    <x-back-nav></x-back-nav>

</x-app-layout>