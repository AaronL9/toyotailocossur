<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InquiryModel;
use App\Models\VehiclesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Inquiry extends AdminBaseController
{
    public function getIndex($id = null, $vehicle_no = null)
    {
        if ($id) {
            if ($vehicle_no) {
                $data['vehicle'] = model(VehiclesModel::class)->find($vehicle_no);
            }

            $data['cc'] = model(InquiryModel::class)->find($id);

            return view('admin/inquiry/inquiry-show-view', $data);
        }

        $data['page'] = 'inquiry';

        return view('admin/inquiry/inquiry-view', $data);
    }
}
