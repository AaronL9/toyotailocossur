<?php

namespace App\Controllers\Api;

use App\Models\VariantsModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class VariantsApi extends ResourceController
{
    protected $modelName = VariantsModel::class;
    protected $format = 'json';

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var Variants */
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
            ->join("vehicles", "variants.vehicle_no = vehicles.vehicle_no")
            ->like("vehicle_title", $search, "both")
            ->orlike('variant_model', $search, 'both')
            ->paginate(10, "default", $page);

        $pageDetails = $this->model->pager->getDetails();

        return $this->respond([
            "pagination" => $pageDetails,
            "variants" => $data
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
    public function new() {}

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
            'vehicle' => 'required',
            'model' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $entry = [
            'vehicle_no' => $json['vehicle'],
            'variant_model' => $json['model'],
            'variant_price' => $json['price'],
            'variant_price_month' => $json['price_month'],
            'variant_isdefault' => $json['isdefault'] ?? 0,
            'variant_isshowprice' => $json['isshowprice'] ?? 0,
            'variant_encode' => session()->get('admin')['user_no'] ?? null
        ];

        $isInserted = $this->model->insert($entry, false);

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
                "message" => "No resources found",
                "errors" => $this->validator->getErrors()
            ], 400);
        }

        $json = json_decode($this->request->getBody(), true);

        $rules = [
            'vehicle' => 'required',
            'model' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "csrf_token" => csrf_hash(),
                "message" => "Validation Error",
                "errors" => $this->validator->getErrors()
            ], 422);
        }

        $data['vehicle_no'] = $json['vehicle'];
        $data['variant_model'] = $json['model'];
        $data['variant_price'] = $json['price'];
        $data['variant_price_month'] = $json['price_month'];
        $data['variant_isdefault'] = $json['isdefault'] ?? 0;
        $data['variant_isshowprice'] = $json['isshowprice'] ?? 0;
        $data['variant_encode'] = session()->get('admin')['user_no'] ?? null;

        $isInserted = $this->model->update($id, $data, false);

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
