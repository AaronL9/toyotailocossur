<?php

namespace App\Models;

use CodeIgniter\Model;

class VariantsModel extends Model
{
    protected $table            = 'variants';
    protected $primaryKey       = 'variant_no';
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'vehicle_no',
        'variant_model',
        'variant_price',
        'variant_price_month',
        'variant_isshowprice',
        'variant_isdefault',
        'variant_encode',
        'variant_encode_date',
        'variant_inactive',
        'variant_delete'
    ];

    /**
     * Get all variants for a given vehicle, including vehicle title.
     */
    public function getByVehicleNo(int $vehicleNo): array
    {
        return $this
            ->builder('variants')
            ->select([
                'variants.variant_no',
                'variants.variant_model',
                'variants.variant_price',
                'variants.variant_price_month',
                'variants.variant_isdefault',
                'vehicles.vehicle_title',
                'photos.variant_filename'
            ])
            ->join('vehicles', 'vehicles.vehicle_no = variants.vehicle_no', 'left')
            ->join('photos', 'photos.variant_no = variants.variant_no', 'left')
            ->where('variants.vehicle_no', $vehicleNo)
            ->where('photos.variant_isprimary', 1)
            ->get()
            ->getResultArray();
    }
}
