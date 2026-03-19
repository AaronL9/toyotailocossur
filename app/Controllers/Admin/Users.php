<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{
    public function getIndex()
    {
        $data["page"] = "users";

        return view("admin/users/user-view", $data);
    }
}
