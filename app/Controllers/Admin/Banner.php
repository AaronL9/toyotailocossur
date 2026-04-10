<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BannerModel;
use CodeIgniter\HTTP\ResponseInterface;

class Banner extends AdminBaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = model(BannerModel::class);
    }

    public function getIndex()
    {
        $data['banners'] = $this->model->findAll();

        return view('admin/banner/banner-view', $data);
    }

    public function postStore()
    {
        $data = $this->request->getPost();

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
                ->back()
                ->with("error", $msg);
        }

        $img = $this->request->getFile('userfile');

        if (!$img->hasMoved()) {

            $filename = "{$img->getFilename()}.{$img->getExtension()}";
            $this->model->insert([
                'banner_photo' => $filename,
                'banner_title' => $data['banner_title'],
                'banner_heading' => $data['banner_heading'],
                'banner_heading' => $data['banner_subheading'],
            ]);
            $img->move(FCPATH . "img/banners", $filename, true);

            return redirect()->back()->with('success', 'The fila has been uploaded successfully');
        }

        return redirect()
            ->back()
            ->with("error", "The file has already been moved.");
    }

    public function deleteIndex($id = null)
    {
        if (!$id) {
            return redirect()->back();
        }

        $banner = $this->model->find($id);

        if (!$banner) {
            return redirect()->back()->with('error', 'Data cannot be deleted');
        }

        // 1. Delete existing files with same base name (any extension)
        foreach (glob(FCPATH . "img/banners/{$banner->banner_photo}") as $existingFile) {
            unlink($existingFile);
        }

        $this->model->delete($id);

        return redirect()->back()->with('success', 'Successfully remove');
    }
}
