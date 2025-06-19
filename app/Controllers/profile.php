<?php 
namespace App\Controllers;

class Profile extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Profile - TIBRA HARDWARE',
            'session' => $session
        ];

        return view('profile_view', $data);
    }

    public function update()
{
    $session = \Config\Services::session();
    if (!$session->get('logged_in')) {
        return redirect()->to('/login');
    }

    // Ambil data dari form
    $data = [
        'fullname' => $this->request->getPost('fullname'),
        'email' => $this->request->getPost('email'),
        'phone' => $this->request->getPost('phone'),
        'address' => $this->request->getPost('address')
    ];

    // Simpan ke session (atau ke database jika sudah terintegrasi)
    $session->set($data);

    return redirect()->to('/profile')->with('message', 'Profile updated successfully');
}
}