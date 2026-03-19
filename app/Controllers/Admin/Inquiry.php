<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InquiryModel;
use CodeIgniter\HTTP\ResponseInterface;

class Inquiry extends BaseController
{
    public function getIndex($id = null)
    {
        if ($id) {
            $data['cc'] = model(InquiryModel::class)->find($id);

            return view('admin/inquiry/inquiry-show-view', $data);
        }

        $data['page'] = 'inquiry';

        return view('admin/inquiry/inquiry-view', $data);
    }
}
