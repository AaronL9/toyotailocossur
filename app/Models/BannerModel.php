<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table            = 'banners';
    protected $primaryKey       = 'banner_no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "banner_title",
        "banner_heading",
        "banner_subheading",
        "banner_photo",
        "banner_inactive",
        "banner_delete"
    ];
}
