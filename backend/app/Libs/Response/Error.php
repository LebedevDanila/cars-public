<?php

namespace App\Libs\Response;

use Illuminate\Http\JsonResponse;

class Error extends JsonResponse
{

    public function __construct($data = null, $status = 200, $headers = [], $options = JSON_UNESCAPED_UNICODE)
    {
        $response = [
            'status' => 'error',
            'data'   => is_null($data) ? 'Ошибка не обработана' : $data,
        ];
        parent::__construct($response, $status, $headers, $options);
    }


}

