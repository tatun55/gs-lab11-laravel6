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
        switch ($this->route()->getName()) {
            case 'books.store':
                $rules = [
                    'item_name' => 'required|string|max:255',
                    'item_number' => 'required|integer|max:500',
                    'item_amount' => 'required|integer|between:100,99999',
                    'item_category' => 'required|integer|between:1,3',
                    'item_img' => 'file|image',
                    'tags' => 'array',
                    'tags.*' => 'integer|between:1,3',
                    'published' => 'required|date',
                ];
                break;
            case 'books.update':
                $rules = [
                    'item_name' => 'required|string|max:255',
                    'item_number' => 'required|integer|max:500',
                    'item_amount' => 'required|integer|between:100,99999',
                    'item_category' => 'required|integer|between:1,3',
                    'tags' => 'array',
                    'tags.*' => 'integer|between:1,3',
                    'published' => 'required|date',
                ];
                break;
        }
        return $rules;
    }
}