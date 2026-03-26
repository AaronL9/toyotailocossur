<?php

namespace App\Controllers;

use App\Models\VehicleModel;
use App\Models\VehiclesModel;

class Home extends BaseController
{
    protected $vehicleModel;

    public function __construct()
    {
        $this->vehicleModel = model(VehiclesModel::class);
    }

    public function getIndex(): string
    {
        $db = db_connect();
        $data["banners"] = $db->table("banners")->select()->get()->getResult();
        $data["vehicles"] = $this->vehicleModel->getVehiclePhotos();
        $data["agents"] = $db
            ->table("agents")
            ->where('agent_inactive', 0)
            ->where('agent_delete', 0)
            ->select()
            ->get("4")
            ->getResult();

        return view('home', $data);
    }
}
