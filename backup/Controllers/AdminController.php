<?php

namespace App\Controllers;
use App\Models\ProdukModel;

class AdminController extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        $this->produkModel = new \App\Models\ProdukModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['produk'] = $this->produkModel->findAll();
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        return view('Admin/index.php',$data);
    }

    public function produk(): string
    {
        $data['produk'] = $this->produkModel->findAll();
        return view('Admin/produk.php',$data);
    }

    public function diskon(): string
    {
        return view('Admin/discount.php');
    }

    public function user(): string
    {
        return view('Admin/user.php');
    }

    public function store()
    {
        if (!$this->validate([
            'nama_produk'    => 'required',
            'harga_produk'   => 'required|numeric',
            'tahun_pembuatan'=> 'required|numeric|exact_length[4]',
            'photo_produk'   => 'max_size[photo_produk,2048]|is_image[photo_produk]|mime_in[photo_produk,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload photo
        $filePhoto = $this->request->getFile('photo_produk');
        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            $newName = $filePhoto->getRandomName();
            $filePhoto->move('uploads/', $newName);
        } else {
            $newName = null;
        }

        $this->produkModel->save([
            'nama_produk'     => $this->request->getPost('nama_produk'),
            'harga_produk'    => $this->request->getPost('harga_produk'),
            'deskripsi_produk'=> $this->request->getPost('deskripsi_produk'),
            'merk_produk'     => $this->request->getPost('merk_produk'),
            'type_produk'     => $this->request->getPost('type_produk'),
            'tahun_pembuatan' => $this->request->getPost('tahun_pembuatan'),
            'photo_produk'    => $newName
        ]);

        return redirect()->to('/produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update($id)
    {
        $produkLama = $this->produkModel->find($id);

        // Validasi
        if (!$this->validate([
            'nama_produk'    => 'required',
            'harga_produk'   => 'required|numeric',
            'tahun_pembuatan'=> 'required|numeric|exact_length[4]',
            'photo_produk'   => 'max_size[photo_produk,2048]|is_image[photo_produk]|mime_in[photo_produk,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $filePhoto = $this->request->getFile('photo_produk');
        $oldPhoto  = $this->request->getPost('old_photo_produk');

        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            $newName = $filePhoto->getRandomName();
            $filePhoto->move('uploads/', $newName);

            if ($oldPhoto && file_exists('uploads/' . $oldPhoto)) {
                unlink('uploads/' . $oldPhoto);
            }
        } else {
            $newName = $oldPhoto;
        }

        $this->produkModel->update($id, [
            'nama_produk'     => $this->request->getPost('nama_produk'),
            'harga_produk'    => $this->request->getPost('harga_produk'),
            'deskripsi_produk'=> $this->request->getPost('deskripsi_produk'),
            'merk_produk'     => $this->request->getPost('merk_produk'),
            'type_produk'     => $this->request->getPost('type_produk'),
            'tahun_pembuatan' => $this->request->getPost('tahun_pembuatan'),
            'photo_produk'    => $newName
        ]);

        return redirect()->to('/produk')->with('success', 'Produk berhasil diupdate.');
    }

    public function delete($id)
    {
        $produk = $this->produkModel->find($id);
        if ($produk && $produk['photo_produk'] && file_exists('uploads/' . $produk['photo_produk'])) {
            unlink('uploads/' . $produk['photo_produk']);
        }
        $this->produkModel->delete($id);
        return redirect()->to('/produk')->with('success', 'Produk berhasil dihapus.');
    }
}
