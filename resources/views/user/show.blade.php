<x-app-layout>
    <x-slot name="title">会員情報</x-slot>

    <h1>会員情報</h1>

    <nav class="user-links">
        <ul>
            <li>
                <a href="{{ route('user.ordered') }}">注文履歴</a>
            </li>
            <li>
                <a href="{{ route('user.reviewed') }}">レビュー履歴</a>
            </li>
        </ul>
    </nav>

    <div class="common-table">
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

        <x-btns>
            <a href="{{ route('user.edit') }}">修正</a>
            <a href="{{ route('user.delete.confirm') }}">削除</a>
        </x-btns>
    </div>

</x-app-layout>