<?php

namespace App\Models;

use CodeIgniter\Model;

class VariantsSpecificationsModel extends Model
{
    protected $table            = 'variants_specifications';
    protected $primaryKey       = 'vs_no';
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

    public function getVariantFullSpec($id = null)
    {
        // return $this
        //     ->select()
        //     ->join('specifications', 'variants_specifications.spec_no = specifications.spec_no', 'left')
        //     ->join('variants_specifications_category', 'variants_specifications.vsc_no = variants_specifications_category.vsc_no', 'left')
        //     ->join('specifications_category', 'variants_specifications_category.scat_no = specifications_category.scat_no', 'left')
        //     ->findAll();

        return  $this->builder('variants_specifications_category a')
            ->select('a.vsc_no, c.vs_value, d.scat_title, d.scat_no, c.vs_value, e.spec_title, e.spec_no')
            ->join('variants b', 'a.variant_no = b.variant_no', 'inner')
            ->join('variants_specifications c', 'a.vsc_no = c.vsc_no', 'left')
            ->join('specifications_category d', 'a.scat_no = d.scat_no', 'left')
            ->join('specifications e', 'c.spec_no = e.spec_no', 'left')
            ->where('a.variant_no', $id)
            ->get()
            ->getResultArray();
    }

    /**
     * Get all specifications (category + spec + value) for a given variant.
     */
    public function getAllSpecificationsByVariant(int $variantNo): array
    {
        return $this->builder('variants_specifications_category a')
            ->select('c.scat_no, c.scat_title, b.vs_value, d.spec_title')
            ->join('variants_specifications b', 'b.vsc_no = a.vsc_no', 'left')
            ->join('specifications_category c', 'c.scat_no = a.scat_no', 'left')
            ->join('specifications d', 'd.spec_no = b.spec_no', 'left')
            ->where('a.variant_no', $variantNo)
            ->groupBy('c.scat_no')
            ->limit(4)
            ->get()
            ->getResultArray();
    }

    public function getFullSpecificationsByVariant(int $variantNo)
    {
        $result =  $this->builder('variants_specifications_category a')
            ->select('c.scat_no, c.scat_title, b.vs_value, d.spec_title')
            ->join('variants_specifications b', 'b.vsc_no = a.vsc_no', 'left')
            ->join('specifications_category c', 'c.scat_no = a.scat_no', 'left')
            ->join('specifications d', 'd.spec_no = b.spec_no', 'left')
            ->where('a.variant_no', $variantNo)
            ->get()
            ->getResultArray();

        $data = [];
        foreach ($result as $row) {
            $data[$row['scat_title']][] = $row;
        }

        return $data;
    }
}
