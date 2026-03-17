<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Colors extends BaseController
{
    public function getIndex()
    {
        return view('admin/colors/colors-view');
    }
}
