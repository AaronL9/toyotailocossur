<?php

namespace App\Models;

use CodeIgniter\Model;

class PhotoModel extends Model
{
    protected $table            = 'photos';
    protected $primaryKey       = 'photo_no';
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        "variant_no",
        "color_no",
        "variant_filename",
        "variant_filenameRaw",
        "variant_path",
        "variant_fullPath",
        "variant_size",
        "variant_type",
        "variant_encode",
        "variant_encode_date",
        "variant_isprimary",
        "variant_inactive",
        "variant_delete"
    ];

    public function upsert($id, $data)
    {
        $row = $this->where("variant_no", $id)->first();

        if (!$row) {
            $this->insert($data);
        } else {
            // Update the existing photo row for this variant
            $this->update($row->photo_no, $data);
        }
    }
}
