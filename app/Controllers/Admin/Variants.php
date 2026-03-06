<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SpecificationsCategoryModel;
use App\Models\SpecificationsTypeModel;
use App\Models\VariantsModel;
use App\Models\VariantsSpecificationsModel;
use App\Models\VehiclesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Variants extends BaseController
{
    protected $model;
    protected $specificationsCategoryModel;
    protected $specTypeModel;
    protected $variantsSpecificationsModel;

    public function __construct()
    {
        $this->model = new VariantsModel();
        $this->specificationsCategoryModel = new SpecificationsCategoryModel();
        $this->specTypeModel = new SpecificationsTypeModel();
        $this->variantsSpecificationsModel = new VariantsSpecificationsModel();
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
        $data['spec_type'] = $this->specTypeModel->findAll();

        // $spec_categories = [
        //     (object)[
        //         'vsc_no'    => 'VSC001',
        //         'scat_no'   => 'SCAT001',
        //         'scat_name' => 'Engine & Performance',
        //         'specs'     => [
        //             (object)['spec_no' => 'SPEC001', 'spec_name' => 'Engine Type',        'spec_unit' => ''],
        //             (object)['spec_no' => 'SPEC002', 'spec_name' => 'Displacement',       'spec_unit' => 'cc'],
        //             (object)['spec_no' => 'SPEC003', 'spec_name' => 'Max Power',          'spec_unit' => 'hp'],
        //             (object)['spec_no' => 'SPEC004', 'spec_name' => 'Max Torque',         'spec_unit' => 'Nm'],
        //         ],
        //     ],
        //     (object)[
        //         'vsc_no'    => 'VSC002',
        //         'scat_no'   => 'SCAT002',
        //         'scat_name' => 'Transmission',
        //         'specs'     => [
        //             (object)['spec_no' => 'SPEC005', 'spec_name' => 'Transmission Type',  'spec_unit' => ''],
        //             (object)['spec_no' => 'SPEC006', 'spec_name' => 'No. of Gears',       'spec_unit' => ''],
        //             (object)['spec_no' => 'SPEC007', 'spec_name' => 'Drive System',       'spec_unit' => ''],
        //         ],
        //     ],
        //     (object)[
        //         'vsc_no'    => 'VSC003',
        //         'scat_no'   => 'SCAT003',
        //         'scat_name' => 'Dimensions & Weight',
        //         'specs'     => [
        //             (object)['spec_no' => 'SPEC008', 'spec_name' => 'Overall Length',     'spec_unit' => 'mm'],
        //             (object)['spec_no' => 'SPEC009', 'spec_name' => 'Overall Width',      'spec_unit' => 'mm'],
        //             (object)['spec_no' => 'SPEC010', 'spec_name' => 'Overall Height',     'spec_unit' => 'mm'],
        //             (object)['spec_no' => 'SPEC011', 'spec_name' => 'Kerb Weight',        'spec_unit' => 'kg'],
        //         ],
        //     ],
        //     (object)[
        //         'vsc_no'    => 'VSC004',
        //         'scat_no'   => 'SCAT004',
        //         'scat_name' => 'Fuel & Consumption',
        //         'specs'     => [
        //             (object)['spec_no' => 'SPEC012', 'spec_name' => 'Fuel Type',          'spec_unit' => ''],
        //             (object)['spec_no' => 'SPEC013', 'spec_name' => 'Fuel Tank Capacity', 'spec_unit' => 'L'],
        //             (object)['spec_no' => 'SPEC014', 'spec_name' => 'Fuel Consumption',   'spec_unit' => 'L/100km'],
        //         ],
        //     ],
        // ];

        // $data['spec_categories'] = $spec_categories;

        return view('admin/variants/variants-create-view', $data);
    }

    public function getSpecifications($id = null)
    {

        if (!$id) {
            return redirect()->to('admin/variants');
        }

        $data['page'] = 'variants-specifications';
        $data['spec_categories'] = $this->specificationsCategoryModel->findAll();
        $data['spec_type'] = $this->specTypeModel->findAll();
        $data['cc'] = $this->variantsSpecificationsModel->getVariantFullSpec();
        $data['id'] = $id;

        return view('admin/variants-specifications/variants-specifications-view', $data);
    }
}
