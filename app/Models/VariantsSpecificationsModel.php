<?php

namespace App\Models;

use CodeIgniter\Model;

class VariantsSpecificationsModel extends Model
{
    protected $table            = 'variants_specifications';
    protected $primaryKey       = 'vsc_no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        "vs_no",
        "spec_no",
        "vsc_no",
        "vs_value",
        "vs_issummary",
        "vs_order_short",
        "vs_order_details",
        "vs_encode",
        "vs_encode_date",
        "vs_inactive",
        "vs_delete"
    ];

    public function getVariantFullSpec()
    {
        return $this->select()
            ->join('specifications', 'variants_specifications.spec_no = specifications.spec_no', 'left')
            ->join('variants_specifications_category', 'variants_specifications.vsc_no = variants_specifications_category.vsc_no', 'left')
            ->join('specifications_category', 'variants_specifications_category.scat_no = specifications_category.scat_no', 'left')

            ->findAll();
    }
}
