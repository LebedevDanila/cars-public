<?php

namespace App\Http\Requests\CarModel;

use Illuminate\Foundation\Http\FormRequest;

class ListCarModelRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'page'  => 'required|integer',
            'limit' => 'integer|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Параметр :attribute не был передан',
        ];
    }

}
