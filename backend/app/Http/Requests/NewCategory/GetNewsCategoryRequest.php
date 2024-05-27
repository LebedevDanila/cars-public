<?php

namespace App\Http\Requests\NewCategory;

use Illuminate\Foundation\Http\FormRequest;

class GetNewsCategoryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'id' => 'integer',
            'link' => 'required_without_all:id|string'
        ];
    }

    public function messages(): array
    {
        return [
            'required_without_all' => 'Не верно переданные параметры',
        ];
    }

}
