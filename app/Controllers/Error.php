<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Error extends BaseController
{
    public function show404()
    {
        return $this->response
            ->setStatusCode(404)
            ->setBody(view('errors/custom_404'));
    }
}
