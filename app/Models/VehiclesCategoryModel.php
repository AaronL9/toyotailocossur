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
        "vcat_order",
        "vcat_encode",
        "vcat_encode_date",
        "vcat_invactive",
        "vcat_delete"
    ];
}
