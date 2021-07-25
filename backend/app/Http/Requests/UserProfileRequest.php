<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pref' => 'required|integer|between:1,47',
            'birthday' => 'required|date',
            'hurigana' => 'required|string',
        ];
    }
}