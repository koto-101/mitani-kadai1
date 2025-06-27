<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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

    public function rules()
{
    return [
        'last_name' => 'required',
        'first_name' => 'required',
        'gender' => 'required',
        'email' => 'required|email',
        'tel' => 'required|regex:/^\d{2,4}-\d{2,4}-\d{3,4}$/',
        'address' => 'required',
        'building' => 'nullable|string|max:255',
        'category_id' => 'required|in:1,2,3,4',
        'message' => 'required|max:120',
    ];
}

public function messages()
{
    return [
        'last_name.required' => '姓を入力してください',
        'first_name.required' => '名を入力してください',
        'gender.required' => '性別を選択してください',
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => 'メールアドレスはメール形式で入力してください',
        'tel.required' => '電話番号を入力してください',
        'tel.regex' => '電話番号は5桁までの数字で入力してください',
        'address.required' => '住所を入力してください',
        'category.required' => 'お問い合わせの種類を選択してください',
        'message.required' => 'お問い合わせ内容を入力してください',
        'message.max' => 'お問合せ内容は120文字以内で入力してください',
    ];
}

protected function prepareForValidation()
{
    $this->merge([
        'tel' => $this->input('tel1') . '-' . $this->input('tel2') . '-' . $this->input('tel3'),
    ]);
} 
}
