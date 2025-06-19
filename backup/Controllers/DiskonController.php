<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\DiskonModel;
use CodeIgniter\Controller; // Atau gunakan BaseController jika diperlukan

class DiskonController extends Controller
{
    protected $produkModel;
    protected $diskonModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->diskonModel = new DiskonModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['diskon'] = $this->diskonModel->getDiskonWithProduk(); // Ambil data dengan informasi produk
        $data['produk'] = $this->produkModel->findAll(); // Kirim data produk ke view
        return view('Admin/discount.php', $data); // Asumsi view untuk diskon adalah discount.php
    }

    public function store()
    {
        if (!$this->validate([
            'id_produk' => 'required|numeric',
            'diskon'    => 'required|decimal|max_length[3]|greater_than_equal_to[0]|less_than_equal_to[100]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id_produk = $this->request->getPost('id_produk');
        $diskon = $this->request->getPost('diskon');

        // Ambil harga produk dari database
        $produk = $this->produkModel->find($id_produk);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
        $harga_produk = $produk['harga_produk'];

        // Hitung harga akhir
        $harga_akhir = $harga_produk * (1 - ($diskon / 100));

        $this->diskonModel->save([
            'id_produk'   => $id_produk,
            'diskon'      => $diskon,
            'harga_akhir' => $harga_akhir
        ]);
        // Simpan ke tabel log
        $db = \Config\Database::connect();
        $db->table('log')->insert([
            'id_user'    => session()->get('id_user'),
            'fullname'   => session()->get('fullname'),
            'activity'   => 'Telah mengatur diskon ' . $diskon . '% pada produk ' . $produk['nama_produk'],
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil ditambahkan.');
    }

    public function update($id)
    {
        if (!$this->validate([
            'id_produk' => 'required|numeric',
            'diskon'    => 'required|decimal|max_length[3]|greater_than_equal_to[0]|less_than_equal_to[100]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id_produk = $this->request->getPost('id_produk');
        $diskon = $this->request->getPost('diskon');

        // Ambil harga produk dari database
        $produk = $this->produkModel->find($id_produk);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
        $harga_produk = $produk['harga_produk'];

        // Hitung harga akhir
        $harga_akhir = $harga_produk * (1 - ($diskon / 100));

        $this->diskonModel->update($id, [
            'id_produk'   => $id_produk,
            'diskon'      => $diskon,
            'harga_akhir' => $harga_akhir // Simpan harga akhir yang dihitung
        ]);
        $db = \Config\Database::connect();
        $db->table('log')->insert([
            'id_user'    => session()->get('id_user'),
            'fullname'   => session()->get('fullname'),
            'activity'   => 'Telah mengatur diskon ' . $diskon . '% pada produk ' . $produk['nama_produk'],
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil diupdate.');
    }

public function delete($id)
{
    // Ambil data diskon + produk terkait
    $diskon = $this->diskonModel->find($id);
    if (!$diskon) {
        return redirect()->to('/diskon')->with('error', 'Diskon tidak ditemukan.');
    }

    $produk = $this->produkModel->find($diskon['id_produk']);
    $nama_produk = $produk ? $produk['nama_produk'] : 'Unknown';

    // Hapus diskon
    $this->diskonModel->delete($id);

    // Insert ke log
    $db = \Config\Database::connect();
    $db->table('log')->insert([
        'id_user'    => session()->get('id_user'),
        'fullname'   => session()->get('fullname'),
        'activity'   => 'Telah menghapus diskon pada produk ' . $nama_produk,
        'created_at' => date('Y-m-d H:i:s')
    ]);

    return redirect()->to('/diskon')->with('success', 'Diskon berhasil dihapus.');
}

}
