<?php

namespace App\Controllers;
use App\Models\PembelianModel;

class PembelianController extends BaseController
{
    public function simpan()
    {
        // Cek apakah user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $id_user   = session()->get('id_user');
        $id_produk = $this->request->getPost('id_produk');

        // Validasi sederhana
        if (!$id_produk) {
            return redirect()->back()->with('error', 'Produk tidak valid.');
        }

        $pembelianModel = new PembelianModel();
        $data = [
            'id_user' => $id_user,
            'id_produk' => $id_produk,
            'tanggal_pembelian' => date('Y-m-d H:i:s')
        ];

        $pembelianModel->insert($data);

        return redirect()->to('/')->with('success', 'Pembelian berhasil!');
    }
}
