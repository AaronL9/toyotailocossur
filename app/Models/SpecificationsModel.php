<?php

namespace App\Models;

use CodeIgniter\Model;

class SpecificationsModel extends Model
{
    protected $table            = 'specifications';
    protected $primaryKey       = 'spec_no';
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        "spec_title",
        "spec_encode",
        "spec_encode_date",
        "spec_inactive",
        "spec_delete"
    ];
}
