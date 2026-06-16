<?php

namespace App\Controllers\Api;

use App\Models\ColorsModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ColorApi extends ResourceController
{
    protected $modelName = ColorsModel::class;
    protected $format = 'json';

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var ColorsModel */
    protected $model;

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data['colors'] = $this->model
            ->orderBy('color_title', 'ASC')
            ->where('color_delete', 0)
            ->where('color_title IS NOT NULL')
            ->where('color_title !=', '')
            ->orderBy('color_title', 'ASC')
            ->findAll();

        return $this->respond($data['colors']);
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
        if (!$id) {
            return $this->failNotFound();
        }

        $json = json_decode($this->request->getBody(), true);

        $this->model->update($id, [
            'color_title' => $json['color_title'],
            'color_hex_value' => $json['color_hex_value']
        ]);

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
        if (!$id) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "No resources found",
                "errors" => null,
            ]);
        }

        $this->model->update($id, ['color_delete' => 1]);

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully deleted a color",
            "errors" => null,
        ]);
    }
}
