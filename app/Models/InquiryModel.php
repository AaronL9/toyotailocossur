<?php

namespace App\Models;

use CodeIgniter\Model;

class InquiryModel extends Model
{
    protected $table            = 'inquiry';
    protected $primaryKey       = 'inquiry_no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'vehicle_no',
        'inquiry_year',
        'inquiry_plateno',
        'inquiry_milage',
        'inquiry_name',
        'inquiry_contact',
        'inquiry_email',
        'inquiry_content',
        'inquiry_date',
        'inquiry_appointment_date',
        'inquiry_appointment_time',
        'inquiry_inactive',
        'inquiry_delete'
    ];
}
