<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Vehicle extends BaseController
{
    public function getIndex()
    {
        return view("vehicle");
    }
}