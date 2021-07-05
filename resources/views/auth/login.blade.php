<x-app-layout>
    <x-slot name="title">会員ログイン</x-slot>

    <h1>会員ログイン</h1>

    <form class="login-form" method="post" action="{{ route('login') }}">
        @csrf
        <div class="login-form-item">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}">
        </div>
        <div class="login-form-item">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password">
        </div>
        {{-- $errors->any() $errors->all() --}}
        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><x-form.danger>{{ $error }}</x-form.danger></li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-form-item">
            <x-form.input-submit>ログイン</x-form.input-submit>
        </div>
    </form>

</x-app-layout>
