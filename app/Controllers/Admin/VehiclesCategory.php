<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class VehiclesCategory extends BaseController
{
    public function getIndex()
    {
        return view("admin/vehicles-category/vehicles-category-view");
    }
}
