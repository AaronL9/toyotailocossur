<?php

namespace App\Controllers\Api;

use App\Models\CsrModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class CsrApi extends ResourceController
{

    protected $modelName = CsrModel::class;
    protected $format = 'json';

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var CsrModel */
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
            ->like("csr_title", $search, "both")
            ->paginate(10, "default", $page);

        $pageDetails = $this->model->pager->getDetails();

        return $this->respond([
            "pagination" => $pageDetails,
            "data" => $data
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
        if (!$id) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "No resources found",
                "errors" => $this->validator->getErrors()
            ], 400);
        }

        $data = $this->model->find($id);

        return $this->respond(['data' => $data]);
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
            'csr_title' => 'required',
            'csr_content' => 'required',
            'csr_date' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $json['csr_encode_date'] = date('Y-m-d H:i:s');
        $this->model->insert($json);

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully add csr",
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
                "errors" => $this->validator->getErrors()
            ], 400);
        }

        $json = json_decode($this->request->getBody(), true);

        if (isset($json['inactive'])) {
            $this->model->update($id, ['csr_inactive' => $json['inactive']]);

            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Csr status change",
                "errors" => null,
            ]);
        }

        $rules = [
            'csr_title' => 'required',
            'csr_content' => 'required',
            'csr_date' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $this->model->update($id, $json);

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "Updated csr content",
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
        //
    }
}
