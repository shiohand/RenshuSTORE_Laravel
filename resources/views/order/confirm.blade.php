<x-app-layout>
    <x-slot name="title">注文内容確認</x-slot>

    <h1>注文内容確認</h1>

    <h2><div class="h2">注文者情報</div></h2>

    <form class="form common-table" method="post" action="{{ route('order.store') }}">
        @csrf
        <div class="with-signup radio-wrap clearfix">
            <label class="radio-label"><input type="radio" name="with_signup" value="guest"
                {{ request()->with_signup == 'guest' ? 'checked' : 'disabled'  }} >今回だけの注文</label>
            <label class="radio-label"><input type="radio" name="with_signup" value="signup"
                {{ request()->with_signup == 'signup' ? 'checked' : 'disabled'  }} >注文と同時に会員登録</label>
        </div>
        <table>
            <tr>
                <th>メールアドレス</th>
                <td>
                    {{ request()->email }}
                    <input type="hidden" name="email" value="{{ request()->email }}">
                </td>
            </tr>
            <tr>
                <th>お名前</th>
                <td>
                    {{ request()->name }}
                    <input type="hidden" name="name" value="{{ request()->name }}">
                </td>
            </tr>
            <tr>
                <th>郵便番号</th>
                <td>
                    {{ request()->postal1 }} - {{ request()->postal2 }}
                    <input type="hidden" name="postal1" value="{{ request()->postal1 }}">
                    <input type="hidden" name="postal2" value="{{ request()->postal2 }}">
                </td>
            </tr>
            <tr>
                <th>住所</th>
                <td>
                    {{ request()->address }}
                    <input type="hidden" name="address" value="{{ request()->address }}">
                </td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>
                    {{ request()->tel }}
                    <input type="hidden" name="tel" value="{{ request()->tel }}">
                </td>
            </tr>
            <!-- signup -->
            @if (request()->with_signup === 'signup')
                <tr>
                    <th>パスワード</th>
                    <td>
                        **********
                        <input type="hidden" name="password" value="{{ request()->password }}">
                        <input type="hidden" name="password_confirmation" value="{{ request()->password_confirmation }}">
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        @if (request()->gender == '1')
                            男性
                        @elseif (request()->gender == '2')
                            女性
                        @endif
                        <input type="hidden" name="gender" value="{{ request()->gender }}">
                    </td>
                </tr>
                <tr>
                    <th>年代</th>
                    <td>
                        {{ request()->birth }}年代
                        <input type="hidden" name="birth" value="{{ request()->birth }}">
                    </td>
                </tr>
            @endif
        </table>

        <x-confirm-text>こちらの内容でお間違いありませんか？</x-confirm-text>

        <x-btns>
            <x-btn-back />
            <x-form.input-submit>注文を確定する</x-form.input-submit>
        </x-btns>
    </form>

    <h2><div class="h2">カートの中の商品</div></h2>

    <x-cart-items-s></x-cart-items-s>

    <x-btns>
        <x-btn-back-cart></x-btn-back-cart>
    </x-btns>

</x-app-layout>
