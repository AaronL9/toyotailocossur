<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_no';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        "user_no",
        "user_lname",
        "user_fname",
        "user_mname",
        "user_uname",
        "user_pword",
        "user_encode",
        "user_encode_date",
        "user_inactive",
        "user_delete"
    ];
}
