<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Contact extends BaseController
{
    public function getIndex()
    {
        $data['page'] = 'contact';

        return view("contact", $data);
    }
}
