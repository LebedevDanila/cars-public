<?php

namespace App\Http\Requests\CarGeneration;

use Illuminate\Foundation\Http\FormRequest;

class ListCarGenerationRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'brand_id' => 'required|integer',
            'limit'   => 'integer|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Параметр :attribute не был передан',
        ];
    }

}
