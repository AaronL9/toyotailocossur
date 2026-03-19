<?php

namespace App\Models;

use CodeIgniter\Model;

class AgentsModel extends Model
{
    protected $table            = 'agents';
    protected $primaryKey       = 'agent_no';
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        "agent_lname",
        "agent_fname",
        "agent_mname",
        "agent_contact",
        "agent_email",
        "agent_fb",
        "agent_ig",
        "agent_tw",
        "agent_photo",
        "agent_encode",
        "agent_encode_date",
        "agent_inactive",
        "agent_delete"
    ];
}
