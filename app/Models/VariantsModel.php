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
}
