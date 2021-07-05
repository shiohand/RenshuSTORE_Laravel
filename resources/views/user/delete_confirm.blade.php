<x-app-layout>
    <x-slot name="title">登録解除</x-slot>

    <h1>登録解除</h1>

    <form class="form common-table" method="post" action="{{ route('user.destroy') }}">
        @csrf
        @method('DELETE')
        <table>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>パスワード</th>
                <td>**********</td>
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
            <tr>
                <th>性別</th>
                <td>
                    @if ($user->gender == '1')
                        男性
                    @elseif ($user->gender == '2')
                        女性
                    @endif
                </td>
            </tr>
            <tr>
                <th>年代</th>
                <td>{{ $user->birth }}年代</td>
            </tr>
        </table>

        <x-confirm-text>登録を解除してデータを削除します。よろしいですか？</x-confirm-text>

        <x-btns>
            <x-btn-back />
            <x-form.input-submit>登録を解除</x-form.input-submit>
        </x-btns>

    </form>

</x-app-layout>