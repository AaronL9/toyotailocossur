<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SpecificationsCategory extends BaseController
{
    public function getIndex()
    {
        $data['page'] = 'specifications';

        return view("admin/specifications-category/specifications-category-view", $data);
    }
}
