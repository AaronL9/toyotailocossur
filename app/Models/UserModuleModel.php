<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModuleModel extends Model
{
    protected $table            = 'users_modules';
    protected $primaryKey       = 'um_no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'um_no',
        'mod_no',
        'user_no',
        'um_encode',
        'um_encode_date',
        'um_inactive',
        'um_delete'
    ];
}
