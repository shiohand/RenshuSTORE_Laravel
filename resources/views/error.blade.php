<x-app-layout>
    <x-slot name="title">error</x-slot>

    <x-confirm-text>{{ session('error_message') ?? 'エラーが発生しました。' }}</x-confirm-text>

    <x-back-nav></x-back-nav>

</x-app-layout>