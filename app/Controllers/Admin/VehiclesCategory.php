<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VehiclesCategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class VehiclesCategory extends BaseController
{
    public function getIndex($id = null)
    {
        if ($id) {
            $model = model(VehiclesCategoryModel::class);
            $data["cc"] = $model->find($id);

            return view("admin/vehicles-category/vehicles-category-update-view", $data);
        }

        return view("admin/vehicles-category/vehicles-category-view");
    }

    public function getCreate()
    {
        return view("admin/vehicles-category/vehicles-category-create-view");
    }
}
