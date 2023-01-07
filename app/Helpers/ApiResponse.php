<?php

namespace App\Helpers;

use App\Controllers\BaseController;

class ApiResponse extends BaseController
{
    public function success($code, $message, $data = [])
    {
        $resource = [
            'status' => $code,
            'message' => $message,
            'data' => $data
        ];

        return $this->response->setJSON($resource)->setStatusCode($code);       
    }
}