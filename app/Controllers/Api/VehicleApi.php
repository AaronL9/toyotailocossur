<?php

namespace App\Controllers\Api;

use App\Models\VehiclesModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class VehicleApi extends ResourceController
{
    protected $modelName = VehiclesModel::class;
    protected $format = 'json';

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var VehiclesModel */
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

        $this->model->db->transStart();

        $vehicles = $this->model
            ->select('vehicle_title, vehicle_no, vehicle_tagline')
            ->like("vehicle_title", $search, "both")
            ->where('vehicle_delete', 0)
            ->paginate(10, "default", $page);

        $data = [];
        foreach ($vehicles as $row) {
            $categories = $this->model
                ->builder('vehicles_category')
                ->select('category.cat_title')
                ->join('categories category', 'category.cat_no = vehicles_category.cat_no')
                ->where('vehicle_no', $row->vehicle_no)
                ->get()
                ->getResultArray();

            $data[] = [
                'id' => $row->vehicle_no,
                'name' => $row->vehicle_title,
                'tagline' => $row->vehicle_tagline,
                'categories' => array_map(fn($val) => $val['cat_title'], $categories)
            ];
        }

        $this->model->db->transComplete();

        $pageDetails = $this->model->pager->getDetails();

        return $this->respond([
            "pageDetails" => $pageDetails,
            "vehicles" => $data
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
        $json = json_decode($this->request->getBody(), true);

        // return $this->respond(["data from server" => $json]);

        if (!$this->validate('vehicle')) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $vehicleEntry = [
            'vehicle_title' => $json['title'],
            'vehicle_tagline' => $json['tagline'],
            'vehicle_encode' => session()->get('admin')['user_no'] ?? null,
            'vehicle_encode_date' => date('Y-m-d H:i:s')
        ];

        try {
            $this->model->db->transException(true)->transStart();

            $id = $this->model->insert($vehicleEntry);

            $categoryEntry = [];
            foreach ($json['categories'] as $value) {
                $categoryEntry[] = [
                    'vehicle_no' => $id,
                    'cat_no' => $value
                ];
            }

            $this->model->builder('vehicles_category')->insertBatch($categoryEntry, true);

            $this->model->db->transComplete();

            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "You have successfully saved vehicle",
                "errors" => null,
            ]);
        } catch (DatabaseException $e) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Something went wrong",
                "errors" => $this->model->errors(),
            ]);
        }
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
        if (!$id) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "No resources found",
                "errors" => 'Not found',
            ], 404);
        }

        $json = json_decode($this->request->getBody(), true);

        // return $this->respond(["data from server" => $json]);

        if (!$this->validate('vehicle')) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $vehicleEntry = [
            'vehicle_title' => $json['title'],
            'vehicle_tagline' => $json['tagline'],
            'vehicle_encode' => session()->get('admin')['user_no'] ?? null,
            'vehicle_encode_date' => date('Y-m-d H:i:s')
        ];

        try {
            $this->model->db->transException(true)->transStart();

            $this->model->update($id, $vehicleEntry);
            $this->model->builder('vehicles_category')->where('vehicle_no', $id)->delete();

            $categoryEntry = [];
            foreach ($json['categories'] as $value) {
                $categoryEntry[] = [
                    'vehicle_no' => $id,
                    'cat_no' => $value
                ];
            }

            $this->model->builder('vehicles_category')->insertBatch($categoryEntry, true);

            $this->model->db->transComplete();

            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "You have successfully saved vehicle",
                "errors" => null,
            ]);
        } catch (DatabaseException $e) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Something went wrong",
                "errors" => $this->model->errors(),
            ]);
        }
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
         if (!$id) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "No resources found",
                "errors" => 'Not found',
            ], 404);
        }

        $this->model->update($id, ['vehicle_delete' => 1]);

        return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "You have successfully delete a vehicle",
                "errors" => null,
            ]);
    }
}
