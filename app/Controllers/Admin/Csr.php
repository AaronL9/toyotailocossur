<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Csr extends AdminBaseController
{
    public function getIndex()
    {
        return view('admin/csr/csr-view');
    }
}
