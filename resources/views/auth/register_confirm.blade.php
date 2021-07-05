<x-app-layout>
    <x-slot name="title">会員登録確認</x-slot>

    <h1>会員登録確認</h1>

    <form class="form common-table" method="post" action="{{ route('register.store') }}">
        @csrf
        <table>
            <tr>
                <th>メールアドレス</th>
                <td>
                    {{ request()->email }}
                    <input type="hidden" name="email" value="{{ request()->email }}">
                </td>
            </tr>
            <tr>
                <th>パスワード</th>
                <td>
                    **********
                    <input type="hidden" name="password" value="{{ request()->password }}">
                    <input type="hidden" name="password_confirmation" value="{{ request()->password_confirmation }}">
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
        </table>

        <x-confirm-text>この内容で登録しますか？</x-confirm-text>

        <x-btns>
            <x-btn-back></x-btn-back>
            <x-form.input-submit>登録</x-form.input-submit>
        </x-btns>
    </form>

</x-app-layout>
