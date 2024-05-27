<?php

namespace App\Http\Requests\NewsArticle;

use Illuminate\Foundation\Http\FormRequest;

class ListNewsArticleRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'category_id' => 'integer|nullable',
            'page'        => 'integer',
            'limit'       => 'integer',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Параметр :attribute не был передан',
        ];
    }

}
