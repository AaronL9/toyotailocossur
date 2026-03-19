<?php

namespace App\Controllers\Api;

use App\Models\SpecificationsCategoryModel;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class SpecificationsCategoryApi extends ResourceController
{
    protected $modelName = SpecificationsCategoryModel::class;
    protected $format = 'json';

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var SpecificationsCategoryModel */
    protected $model;

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->where('scat_delete', 0)->findAll();

        return $this->respond([
            'specifications' => $data,
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

        $rules = [
            'specification' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $entry = [
            'scat_title' => $json['specification']
        ];

        $this->model->insert($entry);

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully add specification",
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
                "message" => "Resource not found",
                "errors" => null
            ], 404);
        }

        $json = json_decode($this->request->getBody(), true);

        $rules = [
            'specification' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $entry = [
            'scat_title' => $json['specification']
        ];

        $this->model->update($id, $entry);

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully update specification",
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

        $this->model->update($id, ["spec_delete" => 1]);

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "Deleted Successfully",
            "errors" => null,
        ]);
    }
}
