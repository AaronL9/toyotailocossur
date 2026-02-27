<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VehicleModel;
use App\Models\VehiclesCategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class Vehicles extends BaseController
{
    protected $vehiclesCategoryModel;
    protected $vehiclesModel;

    public function __construct()
    {
        $this->vehiclesCategoryModel = model(VehiclesCategoryModel::class);
        $this->vehiclesModel = model(VehicleModel::class);
    }

    public function getIndex($id = null)
    {
        if ($id) {
            $data["cc"] = $this->vehiclesModel->find($id);
            return view("admin/vehicles/vehicles-show-view", $data);
        }

        return view("admin/vehicles/vehicles-view");
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
