<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\CategoryModel;
use App\Models\VariantsModel;
use App\Models\VehiclesCategoryModel;
use App\Models\VehiclesModel;

class Vehicles extends AdminBaseController
{
    protected $vehiclesCategoryModel;
    protected $vehiclesModel;
    protected $categoryModel;
    protected $variantsModel;

    public function __construct()
    {
        $this->vehiclesCategoryModel = model(VehiclesCategoryModel::class);
        $this->vehiclesModel = model(VehiclesModel::class);
        $this->categoryModel = model(CategoryModel::class);
        $this->variantsModel = model(VariantsModel::class);
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

    public function getVariants($id = null)
    {
        $data['page'] = 'vehicles-variants';
        $data['cc'] = $this->vehiclesModel->find($id);

        return view('admin/vehicles/vehicles-variants-view', $data);
    }

    public function variantAddForm($id = null)
    {
        if (!$id) {
            return redirect()->back();
        }

        $data['page'] = 'vehicles-variants-create';
        $data['cc'] = $this->vehiclesModel->find($id);
        $data["categories"] = $this->categoryModel
            ->select("cat_no, cat_title",)
            ->where("cat_delete", 0)
            ->findAll();


        return view('admin/vehicles/vehicles-variants-create-view', $data);
    }

    public function variantEditForm($id = null, $vehicle_no = null)
    {
        $data['page'] = 'variants-update';

        $data['cc'] = $this->vehiclesModel->find($vehicle_no);

        $data['variant'] = $this->variantsModel
            ->join('vehicles', 'variants.vehicle_no = vehicles.vehicle_no', 'left')
            ->find($id);

        $data["categories"] = $this->categoryModel
            ->select("cat_no, cat_title",)
            ->where("cat_delete", 0)
            ->findAll();

        return view('admin/vehicles/vehicles-variants-edit-view', $data);
    }
}
