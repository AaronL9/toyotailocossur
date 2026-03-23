<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends AdminBaseController
{
    public function getIndex()
    {
        $data["page"] = "users";

        return view("admin/users/user-view", $data);
    }

    public function getCreate()
    {
        $data['page'] = 'users-create';

        return view('admin/users/user-create-view', $data);
    }

    public function getModule($id = null)
    {
        $data['page'] = 'users-module';

        $data['user'] = model(UserModel::class)->find($id);

        return view('admin/users/user-module-view', $data);
    }

    public function postStore()
    {
        $rules = [
            'user_lname' => [
                'label' => 'Last Name',
                'rules' => 'required|min_length[2]|max_length[64]|alpha_space',
            ],
            'user_fname' => [
                'label' => 'First Name',
                'rules' => 'required|min_length[2]|max_length[64]|alpha_space',
            ],
            'user_mname' => [
                'label' => 'Middle Name',
                'rules' => 'permit_empty|min_length[2]|max_length[64]|alpha_space',
            ],
            'user_uname' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[32]|alpha_numeric|is_unique[users.user_uname]',
            ],
            'user_pword' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[255]',
            ],
            'user_pword_confirm' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[user_pword]',
            ],
            'user_inactive' => [
                'label' => 'Account Status',
                'rules' => 'permit_empty|in_list[1]',
            ],
        ];

        if (! $this->validate($rules)) {
            // Flatten errors so the view can read them as
            // session()->getFlashdata('errors.field_name')
            foreach ($this->validator->getErrors() as $field => $message) {
                session()->setFlashdata("errors.{$field}", $message);
            }

            return redirect()->back()->withInput();
        }

        $userModel = model('UserModel');

        $data = [
            'user_lname'       => trim($this->request->getPost('user_lname')),
            'user_fname'       => trim($this->request->getPost('user_fname')),
            'user_mname'       => trim($this->request->getPost('user_mname')) ?: null,
            'user_uname'       => trim($this->request->getPost('user_uname')),
            'user_pword'       => password_hash(
                $this->request->getPost('user_pword'),
                PASSWORD_BCRYPT
            ),
            'user_inactive'    => (int) (bool) $this->request->getPost('user_inactive'),
            'user_encode'      => session()->get('user_no'),
            'user_encode_date' => date('Y-m-d H:i:s'),
        ];

        if (! $userModel->insert($data)) {
            session()->setFlashdata('error', 'Failed to create user. Please try again.');

            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', 'User created successfully.');

        return redirect()->to(site_url('admin/users'));
    }
}
