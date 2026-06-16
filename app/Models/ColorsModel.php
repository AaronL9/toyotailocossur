<?php

namespace App\Models;

use CodeIgniter\Model;

class ColorsModel extends Model
{
    protected $table            = 'colors';
    protected $primaryKey       = 'color_no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "color_title",
        "color_hex_value",
        "color_encode",
        "color_encode_date",
        "color_inactive",
        "color_delete"
    ];
}
