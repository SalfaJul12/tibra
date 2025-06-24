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

    // =======================
    // ✅ REGISTER SYSTEM
    // =======================
    public function saveRegister()
    {
        $userModel = new UserModel();

        // Ambil data dari form
        $fullname = $this->request->getPost('fullname');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $address  = $this->request->getPost('address');
        $role     = $this->request->getPost('role') ?? 'Customer';

        // Hash password & siapkan data
        $data = [
            'fullname' => $fullname,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'address'  => $address,
            'role'     => $role
        ];

        // Simpan ke database
        $userModel->insert($data);

        // Ambil data user utk session
        $user = $userModel->where('email', $email)->first();

        // ✅ SET SESSION KONSISTEN id_user
        $session = session();
        $session->set([
            'id_user'   => $user['id_user'], // konsisten
            'fullname'  => $user['fullname'],
            'address'   => $user['address'],
            'role'      => $user['role'],
            'isLoggedIn'=> true,
            'logged_in' => true
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silahkan login.');
    }

    // =======================
    // ✅ LOGIN SYSTEM
    // =======================
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
            // ✅ SET SESSION KONSISTEN id_user
            session()->set([
                'id_user'   => $user['id_user'],
                'fullname'  => $user['fullname'],
                'role'      => $user['role'],
                'address'   => $user['address'],
                'isLoggedIn'=> true,
                'logged_in' => true
            ]);

            // Jika Admin → log aktivitas
            if ($user['role'] === 'Admin') {
                $db = \Config\Database::connect();
                $db->table('log')->insert([
                    'id_user'    => $user['id_user'],
                    'fullname'   => $user['fullname'],
                    'activity'   => 'Telah Login',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                return redirect()->to('dashboard');
            } elseif ($user['role'] === 'Customer') {
                return redirect()->to('/'); // Halaman Customer
            } else {
                return redirect()->to('/');
            }

        } else {
            return redirect()->to('login')->with('error', 'Email atau Password salah');
        }
    }

    // =======================
    // ✅ LOGOUT SYSTEM
    // =======================
    public function logout()
    {
        $role = session()->get('role');
        session()->destroy();

        if ($role === 'Admin') {
            return redirect()->to('/login');
        }
        return redirect()->to('/');
    }

    // =======================
    // ✅ OTP SYSTEM
    // =======================

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Tampilkan form forgot password
    public function forpas(): string
    {
        return view('Login/forgot_password.php');
    }

    // Proses kirim OTP
    public function forgotPasswordProcess()
    {
        $email = $this->request->getPost('email');
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->to('forgot-password')->with('error', 'Email tidak ditemukan');
        }

        $otp = rand(100000, 999999);
        session()->set('otp', $otp);
        session()->set('otp_user_id', $user['id_user']);

        // Tampilkan halaman simulasi OTP
        return view('Login/show_otp', ['otp' => $otp]);
    }

    // Proses verifikasi OTP
    public function verifyOtpProcess()
    {
        $inputOtp = $this->request->getPost('otp');
        $sessionOtp = session()->get('otp');

        if ($inputOtp != $sessionOtp) {
            return redirect()->to('forgot-password')->with('error', 'OTP salah');
        }

        return redirect()->to('/reset-password');
    }

    // Tampilkan form reset password
    public function showResetPasswordForm()
    {
        return view('Login/change_password.php');
    }

    // Proses reset password
    public function resetPasswordProcess()
    {
        $password = $this->request->getPost('password');
        $rePassword = $this->request->getPost('re_password');

        if ($password !== $rePassword) {
            return redirect()->back()->with('error', 'Password tidak sama');
        }

        $id_user = session()->get('otp_user_id');
        $this->userModel->update($id_user, [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        session()->remove(['otp', 'otp_user_id']);

        return redirect()->to('/login')->with('success', 'Password berhasil diubah');
    }
    
}
