<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Vehicles extends BaseController
{
    public function getIndex()
    {
        $data["page"] = "vehicles";
        return view("admin/vehicles/vehicles-view", $data);
    }
}
