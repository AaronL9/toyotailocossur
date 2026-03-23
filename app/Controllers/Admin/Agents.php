<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\AgentsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Agents extends AdminBaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AgentsModel();
    }

    public function getIndex()
    {
        $data['page'] = 'agents';

        return view('admin/agents/agents-view', $data);
    }

    public function getCreate()
    {
        $data['page'] = 'agents-create';
        return view('admin/agents/agents-create-view', $data);
    }

    public function getEdit($id = null)
    {
        if (!$id) {
            return redirect()->to('/admin/agents');
        }

        $model = new AgentsModel();

        $data['page'] = 'agents-edit';
        $data['cc'] = $model->find($id);

        return view('admin/agents/agents-edit-view', $data);
    }

    public function getPicture($id = null)
    {
        if (!$id) {
            return redirect()->to('admin/agents');
        }

        $data['cc'] = $this->model->find($id);

        return view('admin/agents/agents-upload-picture-view', $data);
    }

    public function postUploadPhoto($id = null)
    {
        if (!$id) {
            return redirect()->to("/admin/agents");
        }

        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[userfile,5000]',
                ],
            ],
        ];

        if (!$this->validateData([], $validationRule)) {
            $msg = $this->validator->getError('userfile');

            return redirect()
                ->to("/admin/agents/picture/{$id}")
                ->with("userfile_error", $msg);
        }

        $img = $this->request->getFile('userfile');

        // 1. Delete existing files with same base name (any extension)
        foreach (glob(FCPATH . "img/agents/{$id}.*") as $existingFile) {
            unlink($existingFile);
        }

        if (!$img->hasMoved()) {
            $filename = "{$id}.{$img->getExtension()}";
            $this->model->update($id, ["agent_photo" => $filename]);
            $img->move(FCPATH . "img/agents", $filename, true);

            return redirect()->to("/admin/agents/picture/{$id}");
        }

        return redirect()
            ->to("/admin/agents/picture/{$id}")
            ->with("userfile_error", "The file has already been moved.");
    }
}
