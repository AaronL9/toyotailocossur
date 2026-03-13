<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\VehicleModel;
use App\Models\VehiclesCategoryModel;
use App\Models\VehiclesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Showroom extends BaseController
{
    protected $categoryModel;
    protected $vehicleModel;

    public function __construct()
    {
        $this->vehicleModel = model(VehiclesModel::class);
        $this->categoryModel = model(CategoryModel::class);
    }

    public function getIndex()
    {
        $data["page"] = "showroom";
        $data["vehicles_category"] = $this->categoryModel->findAll();
        // $data["vehicles"] = $this->vehicleModel
        //     ->select()
        //     ->join("vehicles_category", "vehicles.vcat_no = vehicles_category.vcat_no", "left")
        //     ->join("variants", "vehicles.vehicle_no = variants.vehicle_no", "left")
        //     ->join("photos", "photos.variant_no = variants.variant_no", "left")
        //     ->where('variant_isdefault', 1)
        //     ->findAll();

        $subQuery = $this->vehicleModel->builder('photos p')
            ->select('p.photo_no, p.variant_filename, p.variant_no')
            ->where('p.variant_isprimary', 1)
            ->getCompiledSelect();

        $data['vehicles'] = $this->vehicleModel
            ->builder('vehicles_category')
            ->select([
                'vehicles.vehicle_no',
                'vehicles.vehicle_title',
                'vehicles_category.cat_no',
                'categories.cat_title',
                'variants.variant_no',
                'picture.variant_filename',
            ])
            ->join('vehicles', 'vehicles.vehicle_no = vehicles_category.vehicle_no', 'left')
            ->join('categories', 'categories.cat_no = vehicles_category.cat_no')
            ->join('variants', 'variants.vehicle_no = vehicles.vehicle_no', 'inner')
            ->join("({$subQuery}) picture", "picture.variant_no = variants.variant_no", "left")
            ->groupBy(['vehicles.vehicle_no', 'vehicles_category.cat_no'])
            // ->where('variant_isdefault', 1)
            // ->where('photos.variant_isprimary', 1)
            ->get()
            ->getResultObject();

        // echo "<pre>";
        // print_r($data['vehicles']);
        // echo "</pre>";
        // exit;

        return view("showroom", $data);
    }
}
