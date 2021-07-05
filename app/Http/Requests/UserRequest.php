<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $route = $this->route()->getName(); // 分岐用ルート名取得

        // 共通ルール
        $rules = [
            'name' => ['required', 'string', 'max:15'],
            'postal1' => ['required', 'integer', 'min:1', 'digits:3'],
            'postal2' => ['required_with:postal1', 'integer', 'min:1', 'digits:4'],
            'address' => ['required', 'string', 'max:50'],
            'tel' => ['required', 'string', 'regex:/\A0[0-9]{1,4}-[0-9]{1,6}(-[0-9]{0,5})?\z/'],
            'gender' => ['required', 'in:1,2'],
            'birth' => ['required', 'integer', 'min:1', 'digits:4'],
        ];

        // ルートごとのルールを追加
        switch ($route) {
            case 'register.confirm':
            case 'register.store':
                $rules['email'] = ['required', 'email', 'unique:users,email'];
                $rules['password'] = ['required', 'string', 'confirmed'];
                break;
            case 'user.update':
                $rules['email'] = ['required', 'email', Rule::unique('users')->ignore(Auth::id())]; // 現在と同じ(変更無し)は許可
                $rules['password'] = ['required', 'string', 'password'];
                $rules['new_password'] = ['nullable', 'string', 'confirmed'];
                break;
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'new_password' => '新しいパスワード',
            'name' => 'お名前',
            'postal1' => '郵便番号',
            'postal2' => '郵便番号',
            'address' => '住所',
            'tel' => '電話番号',
            'gender' => '性別',
            'birth' => '年代',
        ];
    }
}
