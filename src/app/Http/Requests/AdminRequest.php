<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'gender' => 'nullable|in:1,2,3',
            'category_id' => 'nullable|string|max:100',
            'category_match' => 'nullable|in:partial,exact',
            'date' => 'nullable|date',
            'keyword' => 'nullable|string|max:100',
            'target' => 'nullable|in:name,email',
            'match' => 'nullable|in:partial,exact',
        ];
    }
}
