<?php

namespace App\Models;

use CodeIgniter\Model;

class VariantSpecCatModel extends Model
{
    protected $table            = 'variants_specifications_category';
    protected $primaryKey       = 'vsc_no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        "scat_no",
        "variant_no",
        "vsc_order",
        "vsc_encode",
        "vsc_encode_date",
        "vsc_inactive",
        "vsc_delete"
    ];
}
