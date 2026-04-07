<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\CsrModel;
use CodeIgniter\HTTP\ResponseInterface;

class Csr extends AdminBaseController
{
    public function getIndex()
    {
        $data['page'] = 'csr';
        return view('admin/csr/csr-view', $data);
    }

    public function getCreate()
    {
        $data['page'] = 'csr-create';

        return view('admin/csr/csr-create-view', $data);
    }

    public function getEdit($id = null)
    {
        if (!$id) {
            return redirect()->back();
        }

        $data['page'] = 'csr-edit';
        $data['csr'] = model(CsrModel::class)->find($id);

        return view('admin/csr/csr-edit-view', $data);
    }

    public function getPhoto($id = null)
    {
        $data['page'] = 'csr-page';

        $data['csr'] = model(CsrModel::class)->find($id);

        return view('admin/csr/csr-upload-view', $data);
    }

    public function postUpload($id = null)
    {
        if (!$id) {
            return redirect()->back();
        }

        $validationRule = [
            'csr_image' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[csr_image]',
                    'is_image[csr_image]',
                    'mime_in[csr_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[csr_image,10000]',
                ],
            ],
        ];

        if (!$this->validateData([], $validationRule)) {
            $msg = $this->validator->getError('csr_image');

            return redirect()
                ->back()
                ->with("userfile_error", $msg);
        }

        $img = $this->request->getFile('csr_image');

        // 1. Delete existing files with same base name (any extension)
        foreach (glob(FCPATH . "img/csr/{$id}.*") as $existingFile) {
            unlink($existingFile);
        }

        if (!$img->hasMoved()) {
            $filename = "{$id}-{$img->getFilename()}.{$img->getExtension()}";
            $destDir = FCPATH . 'img/csr';
            $img->move($destDir, $filename, true);

            model(CsrModel::class)->update($id, ['csr_image' => $filename]);

            return redirect()->back()->with('success', 'Image has been uploaded successfully');
        }

        return redirect()
            ->back()
            ->with("userfile_error", "The file has already been moved.");
    }
}
