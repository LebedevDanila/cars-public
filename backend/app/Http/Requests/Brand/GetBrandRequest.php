<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class GetBrandRequest extends FormRequest
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
