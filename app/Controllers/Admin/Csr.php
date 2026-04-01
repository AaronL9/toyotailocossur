<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Csr extends AdminBaseController
{
    public function getIndex()
    {
        $data['page'] = 'csr';
        return view('admin/csr/csr-view', $data);
    }

    public function getCreate()
    {
        return view('admin/csr/csr-create-view');
    }
}
