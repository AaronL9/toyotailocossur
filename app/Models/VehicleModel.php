<?php

namespace App\Models;

use CodeIgniter\Model;

class VehicleModel extends Model
{
    protected $table            = 'vehicles';
    protected $primaryKey       = 'vehicle_no';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        "vehicle_no",
        "variant_model",
        "variant_price",
        "variant_price_month",
        "variant_isshowprice",
        "variant_isdefault",
        "variant_encode",
        "variant_encode_date",
        "variant_inactive",
        "variant_delete"
    ];

    public function getVehiclePhotos()
    {
        $data = $this
            ->select("vehicles.vehicle_title ,photos.*")
            ->join("variants", "vehicles.vehicle_no = variants.vehicle_no", "left")
            ->join("photos", "photos.variant_no = variants.variant_no", "left")
            ->findAll(4);

        return $data;
    }
}
