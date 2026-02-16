<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Showroom extends BaseController
{
    public function getIndex()
    {
        return view("showroom");
    }
}