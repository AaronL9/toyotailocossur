<?php

namespace App\Controllers\Api;

use App\Models\AgentsModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class AgentsApi extends ResourceController
{
    protected $modelName = AgentsModel::class;
    protected $format = 'json';

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var AgentsModel */
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
            ->like("agent_fname", $search, "both")
            ->orLike('agent_mname', $search, 'both')
            ->orLike('agent_lname', $search, 'both')
            ->where("agent_delete", 0)
            ->paginate(10, "default", $page);

        $pageDetails = $this->model->pager->getDetails();

        return $this->respond([
            "pagination" => $pageDetails,
            "agents" => $data
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

        if (!$this->validate('agents')) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Invalid Inputs",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $entry = [];
        foreach ($json as $key => $value) {
            $entry["agent_{$key}"] = $value ?: null;
        }
        $entry['agent_encode_date'] = date('Y-m-d H:i:s');
        $entry['agent_encode'] = session()->get('admin')['user_no'];

        $this->model->insert($entry);

        return $this->respond([
            'csrf_token' => csrf_hash(),
            'message' => 'Successfully Saved',
            'errors' => null
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
                "message" => "Something went wrong editing agents",
                "errors" => null
            ], 400);
        }

        $json = json_decode($this->request->getBody(), true);

        if (!$this->validate('agents')) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Invalid Inputs",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $entry = [];
        foreach ($json as $key => $value) {
            $entry["agent_{$key}"] = $value ?: null;
        }
        $entry['agent_encode_date'] = date('Y-m-d H:i:s');
        $entry['agent_encode'] = session()->get('admin')['user_no'];

        $this->model->update($id, $entry);

        return $this->respond([
            'csrf_token' => csrf_hash(),
            'message' => 'Successfully Saved',
            'errors' => null
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
