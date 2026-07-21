<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AboutUs extends BaseController
{
    public function getIndex()
    {
        return view('about-us');
    }
}
