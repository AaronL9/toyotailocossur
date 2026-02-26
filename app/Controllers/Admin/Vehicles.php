<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VehiclesCategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class Vehicles extends BaseController
{
    protected $vehiclesCategoryModel;

    public function __construct()
    {
        $this->vehiclesCategoryModel = model(VehiclesCategoryModel::class);
    }

    public function getIndex()
    {
        $data["page"] = "vehicles";
        return view("admin/vehicles/vehicles-view", $data);
    }

    public function getCreate()
    {
        $data["vehiclesCategory"] = $this->vehiclesCategoryModel
            ->select("vcat_no, vcat_title",)
            ->where("vcat_delete", 0)
            ->findAll();

        return view("admin/vehicles/vehicles-create-view", $data);
    }
}
