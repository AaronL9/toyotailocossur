<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Csr extends BaseController
{
    public function getIndex()
    {
        $data['page'] = 'csr';

        return view("csr", $data);
    }
}