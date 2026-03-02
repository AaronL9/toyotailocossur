<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VehicleModel;
use App\Models\VehiclesCategoryModel;
use App\Models\VehiclesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Showroom extends BaseController
{
    protected $vehiclesCategoryModel;
    protected $vehicleModel;

    public function __construct()
    {
        $this->vehicleModel = model(VehiclesModel::class);
        $this->vehiclesCategoryModel = model(VehiclesCategoryModel::class);
    }

    public function getIndex()
    {
        $data["page"] = "showroom";
        $data["vehicles_category"] = $this->vehiclesCategoryModel->findAll();
        $data["vehicles"] = $this->vehicleModel
            ->select()
            ->join("vehicles_category", "vehicles.vcat_no = vehicles_category.vcat_no", "left")
            ->join("variants", "vehicles.vehicle_no = variants.vehicle_no", "left")
            ->join("photos", "photos.variant_no = variants.variant_no", "left")
            ->findAll();

        return view("showroom", $data);
    }
}
