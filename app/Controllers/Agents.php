<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AgentsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Agents extends BaseController
{
    public function getIndex()
    {
        $data['agents'] = model(AgentsModel::class)->where('agent_delete', 0)->findAll();
        return view('agents', $data);
    }
}
