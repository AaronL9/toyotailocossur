<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Test extends BaseController
{
    public function getIndex()
    {
        return view("/partials/test");
    }
}