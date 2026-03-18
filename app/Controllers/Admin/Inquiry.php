<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Inquiry extends BaseController
{
    public function getIndex()
    {
        return view('admin/inquiry/inquiry-view');
    }
}
