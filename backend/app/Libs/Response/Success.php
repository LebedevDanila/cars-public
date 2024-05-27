<?php

namespace App\Libs\Response;

use Illuminate\Http\JsonResponse;

class Success extends JsonResponse
{

    public function __construct($data = null, $status = 200, $headers = [], $options = JSON_UNESCAPED_UNICODE)
    {
        $response = [
            'status' => 'success',
            'data'   => is_null($data) ? [] : $data,
        ];
        parent::__construct($response, $status, $headers, $options);
    }


}

