<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'cat_no';
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        "cat_title",
        "cat_order",
        "cat_encode",
        "cat_encode_date",
        "cat_inactive",
        "cat_delete"
    ];
}
