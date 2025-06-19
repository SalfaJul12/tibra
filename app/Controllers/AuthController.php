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

        // Ambil data dari form
        $fullname = $this->request->getPost('fullname');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $address  = $this->request->getPost('address');
        $role     = $this->request->getPost('role') ?? 'Customer';

        // Hash password dan siapkan data
        $data = [
            'fullname' => $fullname,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'address'  => $address,
            'role'     => $role
        ];

        // Simpan ke database
        $userModel->insert($data);

        // Ambil data user untuk session
        $user = $userModel->where('email', $email)->first();

        // Set session
        $session = session();
        $session->set([
            'isLoggedIn' => true,
            'id'         => $user['id_user'], // disesuaikan dengan nama kolom ID Anda
            'fullname'   => $user['fullname'],
            'address'    => $user['address']
        ]);

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
                $db = \Config\Database::connect();
                $db->table('log')->insert([
                    'id_user' => $user['id_user'],
                    'fullname'   => $user['fullname'],
                    'activity' => 'Telah Login',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
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
        $role = session()->get('role'); // Ambil role dari session
        session()->destroy();

        if ($role === 'Admin') {
            return redirect()->to('/login');
        }

        return redirect()->to('/');
    }
}
