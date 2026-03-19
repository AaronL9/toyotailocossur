<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\VehiclesCategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class VehiclesCategory extends BaseController
{
    protected $data = [];

    public function __construct()
    {
        $this->data["page"] = "vehicles-category";
    }

    public function getIndex($id = null)
    {
        if ($id) {
            $data["page"] = "vehicles-category-update";

            $model = model(CategoryModel::class);
            $data["cc"] = $model->find($id);

            return view("admin/vehicles-category/vehicles-category-update-view", $data);
        }

        $data["page"] = "vehicles-category";
        return view("admin/vehicles-category/vehicles-category-view", $data);
    }

    public function getCreate()
    {
        $data["page"] = "vehicles-category-create";
        return view("admin/vehicles-category/vehicles-category-create-view", $data);
    }
}
