<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiclesCategoryModel extends Model
{
    protected $table            = 'vehicles_category';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        "vcat_no",
        "vcat_title",
        "vcat_order",
        "vcat_encode",
        "vcat_encode_date",
        "vcat_invactive",
        "vcat_delete"
    ];
}
