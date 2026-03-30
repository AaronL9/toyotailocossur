<?php

namespace App\Controllers\Api;

use App\Models\SpecificationsTypeModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class SpecificationsTypeApi extends ResourceController
{

    protected $modelName = SpecificationsTypeModel::class;
    protected $format = 'json';

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var SpecificationsTypeModel */
    protected $model;

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->where('spec_delete', 0)->orderBy('spec_title')->findAll();

        return $this->respond([
            'specifications_type' => $data,
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
            'spec_type' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $entry = [
            'spec_title' => $json['spec_type'],
            'spec_encode_date' => date('Y-m-d H:i:s')
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
                "message" => "No resources found",
                "errors" => null
            ], 422);
        }

        $json = json_decode($this->request->getBody(), true);

        $rules = [
            'spec_type' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $entry = [
            'spec_title' => $json['spec_type'],
            'spec_encode_date' => date('Y-m-d H:i:s')
        ];

        $this->model->update($id, $entry);

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully updated specification type",
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
                "message" => "No resources found",
                "errors" => null
            ], 422);
        }

        $this->model->update($id, ['spec_delete' => 1]);

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully deleted specification type",
            "errors" => null,
        ]);
    }
}
