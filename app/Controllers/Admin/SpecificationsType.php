<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SpecificationsType extends AdminBaseController
{
    public function getIndex()
    {
        $data['page'] = 'specifications-type';
        return view('admin/specifications-type/specifications-type-view', $data);
    }
}
