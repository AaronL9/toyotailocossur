<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VariantsModel;
use App\Models\VariantsSpecificationsModel;
use App\Models\VehiclesCategoryModel;
use App\Models\VehiclesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Vehicle extends BaseController
{
    protected $vehicleModel;
    protected $vehiclesCategoryModel;
    protected $variantsModel;
    protected $vscModel;
    protected $variantsSpecificationsModel;

    public function __construct()
    {
        $this->vehicleModel = model(VehiclesModel::class);
        $this->vehiclesCategoryModel = model(VehiclesCategoryModel::class);
        $this->variantsModel = model(VariantsModel::class);
        $this->variantsSpecificationsModel = model(VariantsSpecificationsModel::class);
    }

    public function getIndex()
    {
        return view("vehicle");
    }

    /**
     * Show a vehicle's showroom page with its variants and specifications.
     *
     * Loads variants for the given vehicle, attaches each variant's specifications,
     * and determines the default variant.
     *
     * View data:
     * - **page**: string page identifier (e.g. "showroom")
     * - **variants**: array<object> variants (each variant includes `specifications`)
     * - **cc**: object default variant (where `variant_isdefault` == 1)
     *
     * @param int|string $id Vehicle primary key (`vehicle_no`).
     *
     * @return string Rendered view output.
     */
    public function show($id)
    {

        $data["page"] = "showroom";

        $variants = $this->variantsModel->getByVehicleNo($id);
        for ($i = 0; $i < count($variants); $i++) {
            $variant_no = $variants[$i]['variant_no'];
            $variants[$i]['specifications'] = $this->variantsSpecificationsModel->getAllSpecificationsByVariant($variant_no);
        }

        // Convert variant rows to objects (PHP 5.6+ compatible syntax)
        $data['variants'] = array_map(function (array $row) {
            return (object) $row;
        }, $variants);

        // Find default variant without using arrow functions (older PHP compatibility)
        $defaultVariant = null;
        foreach ($variants as $value) {
            if (isset($value['variant_isdefault']) && $value['variant_isdefault'] == 1) {
                $defaultVariant = $value;
                break;
            }
        }

        $data['cc'] = $defaultVariant ? (object) $defaultVariant : null;

        // echo "<pre>";
        // print_r($data['cc']);
        // echo "</pre>";
        // exit;

        return view("vehicle", $data);
    }
}
