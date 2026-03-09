<?php

namespace App\Controllers\Api;

use App\Models\VariantSpecCatModel;
use App\Models\VariantsSpecificationsModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class VariantsSpecificationsApi extends ResourceController
{
    protected $modelName = VariantsSpecificationsModel::class;
    protected $format = 'json';

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var VariantsSpecificationsModel */
    protected $model;

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {

        $data = $this->model->getVariantFullSpec();
        return $this->respond($data);
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
        $vscModel = new VariantSpecCatModel();

        if (!$this->validate('variants_spec')) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $id = $vscModel->insert([
            "variant_no" => $json['variant'],
            'scat_no' => $json['spec_cat'],
            "vsc_order" => $json['order'] ?? null,
            "vsc_encode" => session()->get('admin')['user_no'] ?? null,
            "vsc_encode_date" => date('Y-m-d H:i:s'),
        ]);

        $isInserted = $this->model->insert([
            'vsc_no' => $id,
            'spec_no' => $json['spec_type'],
            'vs_value' => $json['vs_value']
        ], false);

        if (!$isInserted) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Something went wrong",
                "errors" => $this->model->errors(),
            ]);
        }

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully add Specification",
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
        $json = json_decode($this->request->getBody(), true);

        if (isset($json['inactive'])) {
            $this->model->update($id, [
                "vs_inactive" => $json['inactive']
            ]);

            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "You have successfully update specification",
                "errors" => null,
            ]);
        }

        if (!$this->validate('variants_spec')) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $isUpdated = $this->model->update($id, [
            'vs_value' => $json['vs_value']
        ]);

        if (!$isUpdated) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Something went wrong",
                "errors" => $this->model->errors(),
            ]);
        }

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully update specification {$json['vs_value']}",
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
