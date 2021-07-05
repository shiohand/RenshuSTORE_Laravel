<x-app-layout>
    <x-slot name="title">会員修正</x-slot>

    <h1>会員修正</h1>

    <form class="form common-table" method="post" action="{{ route('user.update') }}">
        @csrf
        @method('put')
        <table>
            <tr>
                <th><label for="email">メールアドレス</label></th>
                <td>
                    <x-form.input-email></x-form.input-email>
                </td>
            </tr>
            <tr>
                <th><label for="password">パスワード</label></th>
                <td>
                    <x-form.input-password></x-form.input-password>
                </td>
            </tr>
            <tr>
                <th><label for="new_password">新しいパスワード</label></th>
                <td>
                    <x-form.input-new_password></x-form.input-new_password>
                </td>
            </tr>
            <tr>
                <th><label for="new_password_confirmation">新しいパスワード再入力</label></th>
                <td>
                    <x-form.input-new_password_confirmation></x-form.input-new_password_confirmation>
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
                <th><label for="gender">性別</label></th>
                <td>
                    <x-form.input-gender></x-form.input-gender>
                </td>
                <td>
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
            <x-btn-back />
            <x-form.input-submit>確認</x-form.input-submit>
        </x-btns>
    </form>

</x-app-layout>