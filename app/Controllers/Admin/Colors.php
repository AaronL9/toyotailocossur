<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\ResponseInterface;

class Colors extends AdminBaseController
{
    public function getIndex()
    {
        return view('admin/colors/colors-view');
    }
}
