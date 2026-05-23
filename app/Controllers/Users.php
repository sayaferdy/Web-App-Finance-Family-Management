<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
    
        if (session()->get('role') !== 'SUPERADMIN') {
            return redirect()->to('/dashboard');
        }

        $model = new UserModel();

        return view('users/index', [
            'users' => $model->findAll()
        ]);
    }

    public function create()
    {
        if (session()->get('role') !== 'SUPERADMIN') {
            return redirect()->to('/dashboard');
        }

        return view('users/create');
    }

    public function store()
    {
        if (session()->get('role') !== 'SUPERADMIN') {
            return redirect()->to('/dashboard');
        }

        $model = new UserModel();

        $model->save([
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => strtoupper($this->request->getPost('role')),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'SUPERADMIN') {
            return redirect()->to('/dashboard');
        }

        $model = new UserModel();

        return view('users/edit', [
            'user' => $model->find($id)
        ]);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'SUPERADMIN') {
            return redirect()->to('/dashboard');
        }

        $model = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'role' => strtoupper($this->request->getPost('role'))
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $model->update($id, $data);

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'SUPERADMIN') {
            return redirect()->to('/dashboard');
        }

        $model = new UserModel();
        $model->delete($id);

        return redirect()->to('/users');
    }

    public function resetPassword($id)
    {
        if (session()->get('role') !== 'SUPERADMIN') {
            return redirect()->to('/dashboard');
        }

        $model = new UserModel();

        $model->update($id, [
            'password' => password_hash('123456', PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/users');
    }

    public function profile()
    {
        $model = new UserModel();

        $user = $model->find(session()->get('user_id'));

        return view('users/profile', [
            'user' => $user
        ]);
    }

    public function updateProfile()
    {
        $model = new UserModel();

        $userId = session()->get('user_id');

        $user = $model->find($userId);

        $username = $this->request->getPost('username');

        /*
        |--------------------------------------------------------------------------
        | VALIDASI USERNAME UNIK
        |--------------------------------------------------------------------------
        */

        $existing = $model
            ->where('username', $username)
            ->where('id !=', $userId)
            ->first();

        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username sudah digunakan');
        }

        $model->update($userId, [
            'name' => $this->request->getPost('name'),
            'username' => $username
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE SESSION
        |--------------------------------------------------------------------------
        */

        session()->set([
            'name' => $this->request->getPost('name')
        ]);

        return redirect()->to('/profile')
            ->with('success', 'Profile berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | CHANGE PASSWORD PAGE
    |--------------------------------------------------------------------------
    */

    public function changePassword()
    {
        return view('users/change_password');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */

    public function updatePassword()
    {
        $model = new UserModel();

        $userId = session()->get('user_id');

        $user = $model->find($userId);

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

    /*
    |--------------------------------------------------------------------------
    | VALIDASI PASSWORD LAMA
    |--------------------------------------------------------------------------
    */

        if (!password_verify($currentPassword, $user['password'])) {

            return redirect()->back()
                ->with('error', 'Password lama salah');
        }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI PASSWORD BARU
    |--------------------------------------------------------------------------
    */

        if (strlen($newPassword) < 6) {

            return redirect()->back()
                ->with('error', 'Password minimal 6 karakter');
        }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI KONFIRMASI
    |--------------------------------------------------------------------------
    */

        if ($newPassword !== $confirmPassword) {

            return redirect()->back()
                ->with('error', 'Konfirmasi password tidak cocok');
        }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */

        $model->update($userId, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/profile')
            ->with('success', 'Password berhasil diganti');
    }
}