<?php

namespace App\Models;

use CodeIgniter\Model;

class CsrModel extends Model
{
    protected $table            = 'csr';
    protected $primaryKey       = 'csr_no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'csr_no',
        'csr_title',
        'csr_content',
        'csr_image',
        'csr_encode',
        'csr_encode_date',
        'csr_inactive',
        'csr_delete'
    ];
}
