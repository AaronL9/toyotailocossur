<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Logout extends AdminBaseController
{
    public function postIndex()
    {
        session()->destroy();
        cache()->delete('modules');

        return redirect()->to('admin/login');
    }
}
