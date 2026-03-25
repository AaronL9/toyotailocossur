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

        $id = $this->request->getGet('variant_id');

        $data = $this->model
            ->builder('variants_specifications_category')
            ->select([
                'variants_specifications_category.vsc_no',
                'variants_specifications_category.variant_no',
                'variants_specifications.vs_no',
                'variants_specifications.vs_value',
                'specifications_category.scat_no',
                'specifications_category.scat_title',
                'specifications.spec_title'
            ])
            ->join('variants_specifications', 'variants_specifications.vsc_no = variants_specifications_category.vsc_no', 'left')
            ->join('specifications', 'specifications.spec_no = variants_specifications.spec_no', 'left')
            ->join('specifications_category', 'specifications_category.scat_no = variants_specifications_category.scat_no', 'right')
            ->where('variants_specifications_category.variant_no', $id)
            ->get()
            ->getResultArray();

        $result = [];

        foreach ($data as $item) {
            $result[$item['scat_title']][] = $item;
        }

        $final = [];

        foreach ($result as $title => $items) {
            $final[] = [
                'title' => $title,
                'items' => $items,
            ];
        }

        return $this->respond($final);
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
            return $this->respond('No resource found');
        }

        $data = $this->model->getVariantFullSpec($id);
        return $this->respond($data);
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
            'vs_value' => $json['vs_value'] ?? null
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
        $json = json_decode($this->request->getBody(), true);

        // if (isset($json['inactive'])) {
        //     $this->model->update($id, [
        //         "vs_inactive" => $json['inactive']
        //     ]);

        //     return $this->respond([
        //         "csrf_token" => csrf_hash(),
        //         "message" => "You have successfully update specification",
        //         "errors" => null,
        //     ]);
        // }

        // if (!$this->validate('variants_spec')) {
        //     return $this->respond([
        //         "csrf_token" => csrf_hash(),
        //         "message" => "Validation Error",
        //         "errors" => $this->validator->getErrors()
        //     ], 422);
        // }

        $isUpdated = $this->model->update($id, [
            'vs_value' => $json['spec_val'],
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
            "message" => "You have successfully update secification",
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
                "errors" => null,
            ], 404);
        }

        $json = json_decode($this->request->getBody(), true);

        $this->model->builder('variants_specifications')->delete(['vs_no' => $json['vs']]);
        $this->model->builder('variants_specifications_category')->delete(['vsc_no' => $json['vsc']]);

        return $this->respond([
            "csrf_token" => csrf_hash(),
            "message" => "You have successfully deleted specification",
            "errors" => null,
        ]);
    }
}
