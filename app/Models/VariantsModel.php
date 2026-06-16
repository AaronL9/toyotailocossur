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
                'variants.variant_isshowprice',
                'vehicles.vehicle_no',
                'vehicles.vehicle_title',
                'photos.variant_filename',
                'colors.color_title',
                'colors.color_hex_value'
            ])
            ->join('vehicles', 'vehicles.vehicle_no = variants.vehicle_no', 'left')
            ->join('photos', 'photos.variant_no = variants.variant_no', 'left')
            ->join('colors', 'colors.color_no = photos.color_no', 'left')
            ->where('variants.vehicle_no', $vehicleNo)
            ->where('photos.variant_isprimary', 1)
            ->where('variants.variant_delete', 0)
            ->where('variants.variant_inactive', 0)
            ->groupBy('variants.variant_no')
            ->get()
            ->getResultArray();
    }

    public function getBaseVariantInfo($id)
    {
        return $this
            ->builder('vehicles')
            ->select([
                // 'vehicles.vehicle_no',
                // 'vehicles.vehicle_title',
                'photos.photo_no',
                'photos.variant_filename',

                'colors.color_no',
                'colors.color_hex_value',
                'colors.color_title'
            ])
            ->join('variants', 'variants.vehicle_no = vehicles.vehicle_no', 'left')
            ->join('photos', 'photos.variant_no = variants.variant_no', 'inner')
            ->join('colors', 'colors.color_no = photos.color_no', 'inner')
            ->where('variants.variant_no', $id)
            // ->where('photos.variant_isprimary', 1)
            ->get()
            ->getResultArray();
    }

    public function getOverallColors(string $id)
    {
        return $this
            ->builder('vehicles')
            ->select([
                // 'vehicles.vehicle_no',
                // 'vehicles.vehicle_title',
                'photos.photo_no',
                'photos.variant_filename',

                'colors.color_no',
                'colors.color_hex_value',
                'colors.color_title'
            ])
            ->join('variants', 'variants.vehicle_no = vehicles.vehicle_no', 'left')
            ->join('photos', 'photos.variant_no = variants.variant_no', 'inner')
            ->join('colors', 'colors.color_no = photos.color_no', 'inner')
            ->where('variants.vehicle_no', $id)
            ->groupBy('color_title')
            // ->where('photos.variant_isprimary', 1)
            ->get()
            ->getResultArray();
    }
}
