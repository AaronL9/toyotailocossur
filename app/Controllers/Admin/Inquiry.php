<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InquiryModel;
use App\Models\VehiclesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Inquiry extends AdminBaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = model(InquiryModel::class);
    }

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

        return view('admin/inquiry/inquiry-menu-view', $data);
    }

    public function getContacts()
    {
        $data['page'] = 'inquiry-contact';

        return view('admin/inquiry/inquiry-contact-view', $data);
    }

    public function getContact($id = null)
    {

        $data['inquiry'] = $this->model
            ->select([
                'inquiry_no as id',
                'inquiry_name as inquirer',
                'inquiry_contact as contact',
                'inquiry_email as email',
                'inquiry_content as message',
                'inquiry_date as date'
            ])
            ->find($id);

        return view('admin/inquiry/inquiry-contact-show-view', $data);
    }

    public function getAppointments()
    {
        $data['page'] = 'inquiry-appointment';
        return view('admin/inquiry/inquiry-appointment-view', $data);
    }

    public function getVehicleInquiries()
    {
        $data['page'] = 'inquiry-vehicle';
        return view('admin/inquiry/inquiry-vehicle-view', $data);
    }

    public function getVehicle($id = null)
    {
        $data['inquiry'] = $this->model
            ->select([
                'inquiry_no as id',
                'inquiry_name as inquirer',
                'inquiry_contact as contact',
                'inquiry_email as email',
                'inquiry_content as message',
                'inquiry_date as date',
                'vehicle_title as vehicle'
            ])
            ->join('vehicles', 'vehicles.vehicle_no = inquiry.inquiry_no', 'left')
            ->find($id);

        return view('admin/inquiry/inquiry-vehicle-show-view', $data);
    }
}
