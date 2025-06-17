<?php

namespace App\Controllers;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index(): string
    {
        return view('Login/login.php');
    }

    public function register(): string
    {
        return view('Login/register.php');
    }

    public function forpas(): string
    {
        return view('Login/forgot_password.php');
    }

    public function changepass(): string
    {
        return view('Login/change_password.php');
    }

    //Login System
    public function saveRegister()
    {
        $userModel = new UserModel();
        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'Customer'
        ];
        $userModel->insert($data);
        return redirect()->to('/login')->with('success', 'Registrasi berhasil');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id_user' => $user['id_user'],
                'fullname' => $user['fullname'],
                'role' => $user['role'],
                'address' => $user['address'],
                'logged_in' => true
            ]);

        if ($user['role'] === 'Admin') {
            return redirect()->to('dashboard');
        } else if ($user['role'] === 'Customer') {
            return redirect()->to('/');  // Halaman utama untuk customer
        } else {
            return redirect()->to('/');
        }
        } else {
            return redirect()->back()->with('error', 'Email atau Password salah');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
