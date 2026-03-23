<?php

namespace App\Controllers\Api;

use App\Models\ModulesModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ModulesApi extends ResourceController
{
    protected $modelName = ModulesModel::class;
    protected $format = 'json';

    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /** @var ModulesModel */
    protected $model;


    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index($userNo = null) {}

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $subquery = $this->model->db->table('users_modules')->select()->where('user_no', $id)->getCompiledSelect();

        $data = $this->model->db
            ->table('modules')
            ->select('modules.*')
            ->select("IF(um.mod_no IS NOT NULL AND um.um_inactive = 0, 1, 0) AS `granted`", false)
            ->join("($subquery) um", 'um.mod_no = modules.mod_no', 'left')
            ->get()
            ->getResultArray();

        $results = array_map(function ($row) {
            $row['granted'] = (bool) ($row['granted'] ?? false); // fallback to false if undefined
            return $row;
        }, $data);

        return $this->respond([
            'modules' => $results
        ]);
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
