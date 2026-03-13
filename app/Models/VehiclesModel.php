<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiclesModel extends Model
{
    protected $table            = 'vehicles';
    protected $primaryKey       = 'vehicle_no';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        "vcat_no",
        "vehicle_title",
        "vehicle_tagline",
        "vehicle_encode",
        "vehicle_encode_date",
        "vehicle_inactive",
        "vehicle_delete"
    ];

    public function getVehiclePhotos()
    {
        $data = $this
            ->select("vehicles.vehicle_title ,photos.*, variants.*")
            ->join("variants", "vehicles.vehicle_no = variants.vehicle_no", "inner")
            ->join("photos", "photos.variant_no = variants.variant_no", "left")
            ->groupBy('vehicles.vehicle_no')
            ->findAll(4);

        return $data;
    }
}
