<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {

            session()->set([
                'user_id' => $user['id'],
                'name'    => $user['name'],
                'role'    => strtoupper($user['role']), // 🔥 penting
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}