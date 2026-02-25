<?php

namespace App\Controllers\Api;

use App\Models\VehicleModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Vehicle extends ResourceController
{
    protected $modelName = VehicleModel::class;

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var VehicleModel */
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

        $data = $this->model
            ->select()
            ->join("vehicles_category", "vehicles.vcat_no = vehicles_category.vcat_no")
            ->like("vehicle_title", $search, "both")
            ->paginate(10, "default", $page);

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
        //
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
