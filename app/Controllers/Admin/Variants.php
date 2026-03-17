<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ColorsModel;
use App\Models\PhotoModel;
use App\Models\SpecificationsCategoryModel;
use App\Models\SpecificationsTypeModel;
use App\Models\VariantsModel;
use App\Models\VariantsSpecificationsModel;
use App\Models\VehiclesModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\ResponseInterface;

class Variants extends BaseController
{
    protected $model;
    protected $specificationsCategoryModel;
    protected $specTypeModel;
    protected $variantsSpecificationsModel;
    protected $photoModel;
    protected $colorModel;

    public function __construct()
    {
        $this->model = new VariantsModel();
        $this->specificationsCategoryModel = new SpecificationsCategoryModel();
        $this->specTypeModel = new SpecificationsTypeModel();
        $this->variantsSpecificationsModel = new VariantsSpecificationsModel();
        $this->photoModel = model(PhotoModel::class);
        $this->colorModel = model(ColorsModel::class);
    }

    public function getIndex($id = null)
    {
        if ($id) {
            $data['page'] = 'variants-update';

            $model = new VehiclesModel();
            $data['vehicles'] = $model->findAll();
            $data['cc'] = $this->model->join('vehicles', 'variants.vehicle_no = vehicles.vehicle_no', 'left')->find($id);

            return view('admin/variants/variants-update-view', $data);
        }

        $data['page'] = 'variants';
        return view("admin/variants/variants-view", $data);
    }

    public function getCreate()
    {

        $data['page'] = 'variants-create';

        $model = new VehiclesModel();

        $data['vehicles'] = $model->findAll();
        // $data['spec_categories'] = $this->specificationsCategoryModel->findAll();
        $data['spec_categories'] = $this->specificationsCategoryModel->findAll();
        $data['spec_type'] = $this->specTypeModel->findAll();

        // $spec_categories = [
        //     (object)[
        //         'vsc_no'    => 'VSC001',
        //         'scat_no'   => 'SCAT001',
        //         'scat_name' => 'Engine & Performance',
        //         'specs'     => [
        //             (object)['spec_no' => 'SPEC001', 'spec_name' => 'Engine Type',        'spec_unit' => ''],
        //             (object)['spec_no' => 'SPEC002', 'spec_name' => 'Displacement',       'spec_unit' => 'cc'],
        //             (object)['spec_no' => 'SPEC003', 'spec_name' => 'Max Power',          'spec_unit' => 'hp'],
        //             (object)['spec_no' => 'SPEC004', 'spec_name' => 'Max Torque',         'spec_unit' => 'Nm'],
        //         ],
        //     ],
        //     (object)[
        //         'vsc_no'    => 'VSC002',
        //         'scat_no'   => 'SCAT002',
        //         'scat_name' => 'Transmission',
        //         'specs'     => [
        //             (object)['spec_no' => 'SPEC005', 'spec_name' => 'Transmission Type',  'spec_unit' => ''],
        //             (object)['spec_no' => 'SPEC006', 'spec_name' => 'No. of Gears',       'spec_unit' => ''],
        //             (object)['spec_no' => 'SPEC007', 'spec_name' => 'Drive System',       'spec_unit' => ''],
        //         ],
        //     ],
        //     (object)[
        //         'vsc_no'    => 'VSC003',
        //         'scat_no'   => 'SCAT003',
        //         'scat_name' => 'Dimensions & Weight',
        //         'specs'     => [
        //             (object)['spec_no' => 'SPEC008', 'spec_name' => 'Overall Length',     'spec_unit' => 'mm'],
        //             (object)['spec_no' => 'SPEC009', 'spec_name' => 'Overall Width',      'spec_unit' => 'mm'],
        //             (object)['spec_no' => 'SPEC010', 'spec_name' => 'Overall Height',     'spec_unit' => 'mm'],
        //             (object)['spec_no' => 'SPEC011', 'spec_name' => 'Kerb Weight',        'spec_unit' => 'kg'],
        //         ],
        //     ],
        //     (object)[
        //         'vsc_no'    => 'VSC004',
        //         'scat_no'   => 'SCAT004',
        //         'scat_name' => 'Fuel & Consumption',
        //         'specs'     => [
        //             (object)['spec_no' => 'SPEC012', 'spec_name' => 'Fuel Type',          'spec_unit' => ''],
        //             (object)['spec_no' => 'SPEC013', 'spec_name' => 'Fuel Tank Capacity', 'spec_unit' => 'L'],
        //             (object)['spec_no' => 'SPEC014', 'spec_name' => 'Fuel Consumption',   'spec_unit' => 'L/100km'],
        //         ],
        //     ],
        // ];

        // $data['spec_categories'] = $spec_categories;

        return view('admin/variants/variants-create-view', $data);
    }

    public function getSpecifications($id = null)
    {

        if (!$id) {
            return redirect()->to('admin/variants');
        }

        $data['page'] = 'variants-specifications';
        $data['spec_categories'] = $this->specificationsCategoryModel->findAll();
        $data['spec_type'] = $this->specTypeModel->findAll();
        $data['cc'] = $this->variantsSpecificationsModel->getVariantFullSpec($id);
        $data['id'] = $id;

        return view('admin/variants-specifications/variants-specifications-view', $data);
    }

    public function getPhoto($id = null)
    {
        if (!$id) {
            return redirect()->to('admin/variants');
        }

        $data['cc'] = $this->model
            ->select('photos.variant_filename, variants.*, vehicles.vehicle_title')
            ->join('photos', 'variants.variant_no = photos.variant_no', 'left')
            ->join('vehicles', 'variants.vehicle_no = vehicles.vehicle_no', 'left')
            ->find($id);

        $data['photos'] = $this->photoModel
            ->select([
                'photos.*',
                'colors.color_hex_value',
                'colors.color_title'
            ])
            ->join('colors', 'colors.color_no = photos.color_no', 'left')
            ->where('variant_no', $id)
            ->findAll();

        $data['gallery'] = $this->model
            ->select('photos.variant_filename, photos.photo_no, photos.variant_no')
            ->join('photos', 'variants.variant_no = photos.variant_no', 'left')
            ->where('photos.variant_no', $id)
            ->where('variant_isprimary', 0)
            ->findAll();

        // echo "<pre>";
        // print_r($data['cc']);
        // echo "</pre>";
        // exit;

        return view('admin/variants/variants-upload-photo', $data);
    }

    public function postUploadPhoto($id = null)
    {
        if (!$id) {
            return redirect()->to("/admin/variants");
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
                ->to("/admin/variants/photo/{$id}")
                ->with("userfile_error", $msg);
        }

        $img = $this->request->getFile('userfile');

        // 1. Delete existing files with same base name (any extension)
        // foreach (glob(FCPATH . "img/variants/{$id}.*") as $existingFile) {
        //     unlink($existingFile);
        // }

        if (!$img->hasMoved()) {
            $filetype = $img->getMimeType();
            $filename = "{$id}-{$img->getFilename()}.{$img->getExtension()}";
            $destDir = FCPATH . 'img/variants';
            $img->move($destDir, $filename, true);

            $fullPath = $destDir . DIRECTORY_SEPARATOR . $filename;


            try {
                db_connect()->transException(true)->transStart();

                $colorId = $this->colorModel->insert([
                    'color_title' => $this->request->getPost('color_title'),
                    'color_hex_value' => $this->request->getPost('color_hex_value'),
                ], true);

                $this->photoModel->insert([
                    'variant_no' => $id,
                    'color_no' => $colorId,
                    'variant_filename' => $filename,
                    'variant_filenameRaw' => $filename,
                    'variant_path' => 'img/variants',
                    'variant_fullPath' => $fullPath,
                    'variant_size' => $img->getSize(),
                    'variant_type' => $filetype,
                    'variant_isprimary' => 1
                ]);

                db_connect()->transComplete();
            } catch (DatabaseException $e) {
                return redirect()->to("/admin/variants/photo/{$id}")->with('error', 'Something went wrong');
            }

            return redirect()->to("/admin/variants/photo/{$id}")->with('success', 'Image has been uploaded successfully');
        }

        return redirect()
            ->to("/admin/variants/photo/{$id}")
            ->with("userfile_error", "The file has already been moved.");
    }

    public function postUploadGallery($id = null)
    {
        if (!$id) {
            return redirect()->to("/admin/variants");
        }

        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[userfile,10000]',
                ],
            ],
        ];

        if (!$this->validateData([], $validationRule)) {
            $msg = $this->validator->getError('userfile');

            return redirect()
                ->to("/admin/variants/photo/{$id}")
                ->with("userfile_error", $msg);
        }

        $img = $this->request->getFile('userfile');

        // 1. Delete existing files with same base name (any extension)
        foreach (glob(FCPATH . "img/gallery/{$id}.*") as $existingFile) {
            unlink($existingFile);
        }

        if (!$img->hasMoved()) {
            $filetype = $img->getMimeType();
            $filename = "{$id}-{$img->getFilename()}.{$img->getExtension()}";
            $destDir = FCPATH . 'img/gallery';
            $img->move($destDir, $filename, true);

            $fullPath = $destDir . DIRECTORY_SEPARATOR . $filename;
            $this->photoModel->insert([
                'variant_no' => $id,
                'variant_filename' => $filename,
                'variant_filenameRaw' => $filename,
                'variant_path' => 'img/gallery',
                'variant_fullPath' => $fullPath,
                'variant_size' => $img->getSize(),
                'variant_type' => $filetype
            ]);

            return redirect()->to("/admin/variants/photo/{$id}")->with('success', 'Image has been uploaded successfully');
        }

        return redirect()
            ->to("/admin/variants/photo/{$id}")
            ->with("userfile_error", "The file has already been moved.");
    }

    public function deletePhoto($id = null, $variant_no = null)
    {
        if (!$id | !$variant_no) {
            return redirect()->to("/admin/variants");
        }

        $photo = $this->photoModel->find($id);

        // 1. Delete existing files with same base name (any extension)
        foreach (glob(FCPATH . "img/gallery/{$photo->variant_filename}") as $existingFile) {
            unlink($existingFile);
        }

        $this->photoModel->delete($id);

        return redirect()->to("/admin/variants/photo/{$variant_no}")->with('success', 'Image has been deleted successfully');
    }
}
