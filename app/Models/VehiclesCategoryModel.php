<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiclesCategoryModel extends Model
{
    protected $table            = 'vehicles_category';
    protected $primaryKey       = 'vcat_no';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        "vcat_title",
        'vehicle_no',
        'cat_no',
        "vcat_order",
        "vcat_encode",
        "vcat_encode_date",
        "vcat_invactive",
        "vcat_delete"
    ];

    public function getVehicleCategoriesId($id)
    {
        $data = $this->select('cat_no')->where('vehicle_no', $id)->findAll();

        return array_map(fn($data) => $data->cat_no, $data);
    }
}
