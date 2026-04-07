<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CsrModel;
use CodeIgniter\HTTP\ResponseInterface;

class Csr extends BaseController
{
    public function getIndex()
    {
        $data['page'] = 'csr';

        $data['articles'] = model(CsrModel::class)
            ->where('csr_delete = 0')
            ->where('csr_inactive = 0')
            ->findAll();

        return view("csr", $data);
    }
}
