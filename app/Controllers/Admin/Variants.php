<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SpecificationsCategoryModel;
use App\Models\SpecificationsModel;
use App\Models\VariantsModel;
use App\Models\VehiclesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Variants extends BaseController
{
    protected $model;
    protected $specificationsCategoryModel;

    public function __construct()
    {
        $this->model = new VariantsModel();
        $this->specificationsCategoryModel = new SpecificationsCategoryModel();
    }

    public function getIndex($id = null)
    {
        if ($id) {
            $data['page'] = 'variants-update';

            $model = new VehiclesModel();
            $data['vehicles'] = $model->findAll();
            $data['cc'] = $this->model->join('vehicles', 'variants.vehicle_no = vehicles.vehicle_no', 'left')->find($id);

            return view('admin/variants/variants-update-view', $data);
        }

        $data['page'] = 'variants';
        return view("admin/variants/variants-view", $data);
    }

    public function getCreate()
    {

        $data['page'] = 'variants-create';

        $model = new VehiclesModel();

        $data['vehicles'] = $model->findAll();
        // $data['spec_categories'] = $this->specificationsCategoryModel->findAll();
        $data['spec_categories'] = $this->specificationsCategoryModel->findAll();

        return view('admin/variants/variants-create-view', $data);
    }
}
