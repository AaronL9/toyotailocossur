<?php

namespace App\Controllers\Api;

use App\Models\VehiclesCategoryModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class VehiclesCategoryApi extends ResourceController
{

    protected $modelName = VehiclesCategoryModel::class;
    protected $format = 'json';

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var VehiclesCategoryModel */
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
            ->like("vcat_title", $search, "both")
            ->where("vcat_delete", 0)
            ->paginate(10, "default", $page);

        $pageDetails = $this->model->pager->getDetails();

        return $this->respond([
            "pagination" => $pageDetails,
            "vehicle_categories" => $data
        ]);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null) {}

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

        $rules = [
            'category_name' => 'required',
            'order' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $data["vcat_title"] = $json["category_name"];
        $data["vcat_order"] = $json["order"];
        $data["vcat_encode"] = session()->get("admin")["user_no"] ?? null;

        $isInserted = $this->model->insert($data, false);

        if (!$isInserted) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Something went wrong",
                "errors" => $this->model->errors(),
            ]);
        }

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully add vehicle category",
            "errors" => null,
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
        if (!$id) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 400);
        }

        $json = json_decode($this->request->getBody(), true);

        $rules = [
            'category_name' => 'required',
            'order' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $data["vcat_title"] = $json["category_name"];
        $data["vcat_order"] = $json["order"];
        $data["vcat_encode"] = session()->get("admin")["user_no"] ?? null;

        $isInserted = $this->model->update($id, $data);

        if (!$isInserted) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Something went wrong",
                "errors" => $this->model->errors(),
            ]);
        }

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully updated vehicle category",
            "errors" => null,
        ]);
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
                "message" => "No resource found",
                "errors" => null,
            ]);
        }

        $this->model->update($id, ["vcat_delete" => 1]);

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "Deleted Successfully",
            "errors" => null,
        ]);
    }
}
