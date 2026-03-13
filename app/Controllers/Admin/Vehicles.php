<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\VehicleModel;
use App\Models\VehiclesCategoryModel;
use App\Models\VehiclesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Vehicles extends BaseController
{
    protected $vehiclesCategoryModel;
    protected $vehiclesModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->vehiclesCategoryModel = model(VehiclesCategoryModel::class);
        $this->vehiclesModel = model(VehiclesModel::class);
        $this->categoryModel = model(CategoryModel::class);
    }

    public function getIndex($id = null)
    {
        if ($id) {
            $data["cc"] = $this->vehiclesModel->find($id);
            return view("admin/vehicles/vehicles-show-view", $data);
        }

        $data['page'] = 'vehicles';
        return view("admin/vehicles/vehicles-view", $data);
    }

    public function getCreate()
    {
        $data['page'] = 'vehicles-create';
        $data["category"] = $this->categoryModel
            ->select("cat_no, cat_title",)
            ->where("cat_delete", 0)
            ->findAll();

        return view("admin/vehicles/vehicles-create-view", $data);
    }

    public function getEdit($id = null)
    {
        if (!$id) {
            return redirect()->to('admin/vehicles');
        }

        $data['page'] = 'vehicles-edit';
        $data["categories"] = $this->categoryModel
            ->select("cat_no, cat_title",)
            ->where("cat_delete", 0)
            ->findAll();

        $data['vehicle_categories'] = $this->vehiclesCategoryModel->getVehicleCategoriesId($id);
        $data['cc'] = $this->vehiclesModel->find($id);

        $data['api'] = "api/vehicle/{$id}";

        return view('admin/vehicles/vehicles-edit-view', $data);
    }
}
