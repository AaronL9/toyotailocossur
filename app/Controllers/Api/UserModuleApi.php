<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class UserModuleApi extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
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
            return $this->respond([
                'csrf_token' => csrf_hash()
            ]);
        }

        $db = db_connect();

        $json = json_decode($this->request->getBody(), true);

        $um = $db->table('users_modules')
            ->where('mod_no', $json['mod_no'])
            ->where('user_no', $id)
            ->get()
            ->getRowArray();

        if (empty($um)) {
            $db->table('users_modules')->insert([
                'mod_no' => $json['mod_no'],
                'user_no' => $id,
                'um_inactive' => (int) !$json['grant']
            ]);
        } else {
            $db->table('users_modules')->update([
                'mod_no' => $json['mod_no'],
                'user_no' => $id,
                'um_inactive' => (int) !$json['grant']
            ], ['um_no' => $um['um_no']]);
        }

        return $this->respond([
            'csrf_token' => csrf_hash(),
            'data' => $json,
            'grant' => (int) $json['grant'],
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
