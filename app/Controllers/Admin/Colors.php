<?php

namespace App\Controllers\Admin;

use App\Models\ColorsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Colors extends AdminBaseController
{
    private $colorModel;

    public function __construct()
    {
        $this->colorModel = new ColorsModel();
    }

    public function getIndex()
    {
        $data['colors'] = $this->colorModel
            ->orderBy('color_title', 'ASC')
            ->where('color_delete', 0)
            ->where('color_title IS NOT NULL')
            ->where('color_title !=', '')
            ->findAll();

        $data['page'] = 'colors';

        return view('admin/colors/colors-view', $data);
    }
}
