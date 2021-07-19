<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'item_name' => 'required|string|max:255',
            'item_number' => 'required|integer|max:500',
            'item_amount' => 'required|integer|between:100,99999',
            'item_category' => 'required|integer|between:1,3',
            'tags' => 'array',
            'tags.*' => 'integer|between:1,3',
            'published' => 'required|date',
        ];

        switch ($this->route()->getName()) {
            case 'books.store':
                $storeRules = [
                    'item_img' => 'file|image',
                ];
                $rules = array_merge($rules, $storeRules);
                break;
            case 'books.update':
                break;
        }

        return $rules;
    }
}