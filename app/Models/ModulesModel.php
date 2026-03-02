<?php

namespace App\Models;

use CodeIgniter\Model;

class ModulesModel extends Model
{
    protected $table            = 'modules';
    protected $primaryKey       = 'module_no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'mod_title',
        'mod_icon',
        'mod_link',
        'mod_encode',
        'mod_encode_date',
        'mod_inactive',
        'mod_delete'
    ];
}
