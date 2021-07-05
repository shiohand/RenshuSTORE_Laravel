<x-app-layout>
    <x-slot name="title">注文フォーム</x-slot>

    <h1>注文フォーム</h1>

    <h2><div class="h2">注文者情報</div></h2>

    <form class="form common-table" method="post" action="{{ route('order.confirm') }}">
        @csrf
        <p class="with-signup-text">注文と同時に会員登録されますと、<br>次回から入力を省略できます。</p>
        <div class="with-signup radio-wrap clearfix">
            <label class="radio-label"><input type="radio" name="with_signup" value="guest"
                {{ old('with_signup', 'guest') == 'guest' ? 'checked' : '' }}>今回だけの注文</label>
            <label class="radio-label"><input type="radio" name="with_signup" value="signup"
                {{ old('with_signup') == 'signup' ? 'checked' : '' }}>注文と同時に会員登録</label>
        </div>

        <table>
            <tr>
                <th><label for="email">メールアドレス</label></th>
                <td>
                    <x-form.input-email></x-form.input-email>
                </td>
            </tr>
            <tr>
                <th><label for="name">お名前</label></th>
                <td>
                    <x-form.input-name></x-form.input-name>
                </td>
            </tr>
            <tr>
                <th><label for="postal1">郵便番号</label></th>
                <td>
                    <x-form.input-postal></x-form.input-postal>
                </td>
            </tr>
            <tr>
                <th><label for="address">住所</label></th>
                <td>
                    <x-form.input-address></x-form.input-address>
                </td>
            </tr>
            <tr>
                <th><label for="tel">電話番号</label></th>
                <td>
                    <x-form.input-tel></x-form.input-tel>
                </td>
            </tr>
            <tr>
                <td class="with-signup-alert" colspan="2">
                    以下、会員登録する場合のみ入力
                </td>
            </tr>
            <tr>
                <th><label for="password">パスワード</label></th>
                <td>
                    <x-form.input-password></x-form.input-password>
                </td>
            </tr>
            <tr>
                <th><label for="password2">パスワード再入力</label></th>
                <td>
                    <x-form.input-password_confirmation></x-form.input-password_confirmation>
                </td>
            </tr>
            <tr>
                <th><label for="gender">性別</label></th>
                <td>
                    <x-form.input-gender></x-form.input-gender>
                </td>
            </tr>
            <tr>
                <th>年代</th>
                <td>
                    <x-form.select-birth></x-form.select-birth>
                </td>
            </tr>
        </table>

        <x-btns>
            <x-btn-back-cart></x-btn-back-cart>
            <x-form.input-submit>確認</x-form.input-submit>
        </x-btns>
    </form>

    <h2><div class="h2">カートの中の商品</div></h2>

    <x-cart-items-s></x-cart-items-s>

    <x-btns>
        <x-btn-back-cart></x-btn-back-cart>
    </x-btns>

</x-app-layout>
