<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Specifications extends BaseController
{
    public function getIndex()
    {
        $data['page'] = 'specifications';

        return view("admin/specifications/specifications-view", $data);
    }
}
