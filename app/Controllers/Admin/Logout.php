<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Logout extends BaseController
{
    public function postIndex()
    {
        session()->destroy();

        return redirect()->to('admin/login');
    }
}
