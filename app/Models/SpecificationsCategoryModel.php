<?php

namespace App\Models;

use CodeIgniter\Model;

class SpecificationsCategoryModel extends Model
{
    protected $table            = 'specifications_category';
    protected $primaryKey       = 'scat_no';
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        "scat_title",
        "scat_encode",
        "scat_encode_date",
        "scat_inactive",
        "scat_delete"
    ];
}
