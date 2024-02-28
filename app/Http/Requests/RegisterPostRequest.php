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
        'over_name_kana' => 'required|string|max:30|regex:/[ァ-ヴー]+/u',
        'under_name_kana'  => 'required|string|max:30|regex:/[ァ-ヴー]+/u',
        'mail_address' => 'required|email|unique:users|max:100',
        'sex' => 'required|in:1,2,3',
        'old_year' => 'required|integer|min:2000|max:' . date('Y'),
        'old_month' => 'required|integer|min:1|max:12',
        'old_day' => 'required|integer|min:1|max:31',
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
        'old_year.required' => '年を入力してください。',
        'old_year.integer' => '年は整数で入力してください。',
        'old_year.min' => '年は2000年以上で入力してください。',
        'old_year.max' => '年は現在の年より小さい値で入力してください。',
        'old_month.required' => '月を入力してください。',
        'old_month.integer' => '月は整数で入力してください。',
        'old_month.min' => '月は1以上で入力してください。',
        'old_month.max' => '月は12以下で入力してください。',
        'old_day.required' => '日を入力してください。',
        'old_day.integer' => '日は整数で入力してください。',
        'old_day.min' => '日は1以上で入力してください。',
        'old_day.max' => '日は31以下で入力してください。',
        'role.required' => '役職の選択は必須です。',
        'role.in' => '役職は教師(国語), 教師(数学), 教師(英語), 生徒のいずれかを選択してください。',
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
