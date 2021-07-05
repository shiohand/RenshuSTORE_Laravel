<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:15'],
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $is_signup = (request()->with_signup === 'signup');
                    $is_exist = User::where('email', request()->email)->exists();
                    if ($is_signup && $is_exist) {
                        $fail("登録済みのメールアドレスです");
                    }
                },
            ],
            'postal1' => ['required', 'integer', 'min:1', 'digits:3'],
            'postal2' => ['required', 'integer', 'min:1', 'digits:4'],
            'address' => ['required', 'string', 'max:50'],
            'tel' => ['required', 'string', 'regex:/\A0[0-9]{1,4}-[0-9]{1,6}(-[0-9]{0,5})?\z/'],
            'with_signup' => ['required', 'in:signup,guest'],
            'password' => ['sometimes', 'nullable', 'required_if:with_signup,signup', 'string', 'confirmed'],
            'gender' => ['sometimes', 'nullable', 'required_if:with_signup,signup', 'in:1,2'],
            'birth' => ['sometimes', 'nullable', 'required_if:with_signup,signup', 'integer', 'min:1', 'digits:4'],
        ];
    }
    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'name' => 'お名前',
            'postal1' => '郵便番号',
            'address' => '住所',
            'tel' => '電話番号',
            'gender' => '性別',
            'birth' => '年代',
        ];
    }
    public function messages()
    {
        return [
            'required_if' => '注文と同時に会員登録を選択している場合は必須入力です。',
        ];
    }
}
