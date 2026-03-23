<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\ResponseInterface;

class Home extends AdminBaseController
{
    public function getIndex()
    {
        $admin = $this->session->get('admin');

        return redirect()->to($admin['access'][0] ?? '/admin/login');
    }
}
