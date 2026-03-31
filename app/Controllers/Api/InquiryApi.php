<?php

namespace App\Controllers\Api;

use App\Models\InquiryModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class InquiryApi extends ResourceController
{
    protected $modelName = InquiryModel::class;
    protected $format = 'json';

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var InquiryModel */
    protected $model;

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $page = $this->request->getGet("page") ?? 1;
        $search = $this->request->getGet("search") ?? "";
        $inquiryType = $this->request->getGet('type') ?? '';

        switch ($inquiryType) {
            case 'contact':
                $data = $this->model
                    ->select([
                        'inquiry_no as id',
                        'inquiry_name as inquirer',
                        'inquiry_contact as contact',
                        'inquiry_email as email',
                        'inquiry_content as message',
                        'inquiry_date as date'
                    ])
                    ->like("inquiry_name", $search, "both")
                    ->where('vehicle_no', null)
                    ->where('inquiry_appointment_date', null)
                    ->where('inquiry_appointment_time', null)
                    ->where("inquiry_delete", 0)
                    ->orderBy('inquiry_date', 'DESC')
                    ->paginate(10, "default", $page);
                break;

            case 'vehicle':
                $data = $this->model
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
                    ->like("inquiry_name", $search, "both")
                    ->where('inquiry.vehicle_no IS NOT NULL')
                    ->where('inquiry_appointment_date', null)
                    ->where('inquiry_appointment_time', null)
                    ->where("inquiry_delete", 0)
                    ->orderBy('inquiry_date', 'DESC')
                    ->paginate(10, "default", $page);
                break;
        }

        $pageDetails = $this->model->pager->getDetails();

        return $this->respond([
            "pagination" => $pageDetails,
            "inquiries" => $data
        ]);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $json = json_decode($this->request->getBody());


        // if (!$this->validate('inquiry')) {
        //     return $this->respond([
        //         "csrf_token" => csrf_hash(),
        //         "message" => "Validation Error",
        //         "errors" => $this->validator->getErrors()
        //     ], 422);
        // }

        $data = [
            'vehicle_no'               => $json->vehicle ?? null,
            'inquiry_year'             => $json->inquiry_year ?? null,
            'inquiry_plateno'          => $json->inquiry_plateno ?? null,
            'inquiry_milage'           => $json->inquiry_mileage ?? null,
            'inquiry_name'             => $json->name ?? null,
            'inquiry_contact'          => $json->phone ?? null,
            'inquiry_email'            => $json->email ?? null,
            'inquiry_content'          => $json->message ?? null,
            'inquiry_date'             => date('Y-m-d H:i:s'),
            'inquiry_appointment_date' => $json->inquiry_appointment_date ?? null,
            'inquiry_appointment_time' => $json->inquiry_appointment_time ?? null,
            'inquiry_inactive'         => 0,
            'inquiry_delete'           => 0,
        ];

        $this->model->insert($data);

        return $this->respond([
            'message' => 'from server',
            'data' => $json,
            'csrf_token' => csrf_hash()
        ]);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
