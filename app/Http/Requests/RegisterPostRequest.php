<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPostRequest extends FormRequest
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
               'over_name' => 'required|string|max:10',
                'under_name' => 'required|string|max:10',
                'over_name_kana' => 'required|string|max:10|regex:/^[ァ-ヶー]+$/',
                'under_name_kana'  => 'required|string|max:10|regex:/^[ァ-ヶー]+$/',
                'mail_address' => 'required|email|unique:users|max:100',
                'sex' => 'required|in:1,2,3',
                'role' => 'required|in:1,2,3,4',
                'password' => 'required|min:8|max:30|',
                'password_confirmation' => 'required|min:8|max:30|same:password'
        ];
    }
   public function messages()
{
    return [
        'over_name.required' => '名字は必須です。',
        'under_name.required' => '名前は必須です。',
        'over_name_kana.required' => '名字（カナ）は必須です。',
        'under_name_kana.required' => '名前（カナ）は必須です。',
        'over_name_kana.regex' => '名字（カナ）はカタカナで入力してください。',
        'under_name_kana.regex' => '名前（カナ）はカタカナで入力してください。',
        'mail_address.required' => 'メールアドレスは必須です。',
        'mail_address.email' => '正しいメールアドレスの形式で入力してください。',
        'mail_address.unique' => 'そのメールアドレスは既に登録されています。',
        'mail_address.max' => 'メールアドレスは100文字以内で入力してください。',
        'sex.required' => '性別は必須です。',
        'sex.in' => '性別は男, 女, その他のいずれかを選択してください。',
        'role.required' => '役職の選択は必須です。',
        'role.in' => '役職はは教師(), 教師(数学), 教師(英語), 生徒のいずれかを選択してください。',
        'password.required' => 'パスワードは必須です。',
        'password.min' => 'パスワードは8文字以上で入力してください。',
        'password.max' => 'パスワードは30文字以内で入力してください。',
        'password_confirmation.required' => 'パスワード確認は必須です。',
        'password_confirmation.min' => 'パスワード確認は8文字以上で入力してください。',
        'password_confirmation.max' => 'パスワード確認は30文字以内で入力してください。',
        'password_confirmation.same' => 'パスワード確認がパスワードと一致しません。',
    ];
}
}
