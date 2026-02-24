<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = model(UserModel::class);
    }

    public function getIndex()
    {

        return view("admin/login-view");
    }

    public function postIndex()
    {
        $session = session();

        $loginCredentials = $this->request->getPost();

        $user = $this->userModel
            ->where("user_uname", $loginCredentials["username"])
            ->where("user_delete", 0)
            ->where("user_inactive", 0)
            ->first();

        if (!$user) {
            return redirect()->back()->with("login_error", "Invalid Credentials");
        }

        if (!password_verify($loginCredentials["password"], $user->user_pword)) {
            return redirect()->back()->with("login_error", "Invalid Credentials");
        }

        $newdata = [
            'name'  => "{$user->user_fname} {$user->user_lname}",
            'logged_in' => true,
        ];

        $session->set('admin', $newdata);

        return redirect()->to("/admin/login");
    }
}
