<?php

namespace App\Controllers;
use App\Models\ProdukModel;
use App\Models\DiskonModel;
use App\Models\UserModel;
use App\Models\PembelianModel;
use App\Models\CartModel;

class AdminController extends BaseController
{
    protected $produkModel;
    protected $diskonModel;
    protected $userModel;
    protected $cartModel;

    protected $id_user;
    
    public function __construct()
    {
        $this->produkModel = new \App\Models\ProdukModel();
        $this->diskonModel = new DiskonModel();
        $this->userModel = new UserModel();
        $this->cartModel = new CartModel();
        helper(['form', 'url']);
        $this->id_user = session()->get('id_user');
    }

    public function index()
    {
        $data['produk'] = $this->produkModel->findAll();
        
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        $db = \Config\Database::connect();
        $data['log'] = $db->table('log')->orderBy('created_at', 'DESC')->get()->getResultArray();

        return view('Admin/index.php', $data);
    }

    public function produk()
    {
        $data['produk'] = $this->produkModel->findAll();
        return view('Admin/produk.php', $data);
    }

    public function diskon()
    {
        // Ambil data produk dan diskon
        $data['produk'] = $this->produkModel->findAll();
        $data['diskon'] = $this->diskonModel->getDiskonWithProduk();
        // Kirim data ke view
        return view('Admin/discount.php', $data);
    }
    

    public function user()
    {
        $data['user'] = $this->userModel->findAll();
        return view('Admin/user.php',$data);
    }

    public function update_user($id)
    {
        if(!$this->validate([
            'fullname' => 'required',
            'email' => 'required'
        ])){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update($id,[
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
        ]);
        session()->set('fullname', $this->request->getPost('fullname'));
        return redirect()->to('/user')->with('success', 'User berhasil diUpdate.');
    }

    public function delete_user($id)
    {
        $user = $this->userModel->find($id);
        $this->userModel->delete($id);
        return redirect()->to('/user')->with('success', 'Produk berhasil dihapus.');
    }

    public function report()
    {
        $pembelianModel = new \App\Models\PembelianModel(); // panggil model
        $data['pembelian'] = $pembelianModel->getLaporanPembelian(); // ambil datanya
        return view('Admin/report', $data); // kirim ke view
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
        $nama_produk = $this->request->getPost('nama_produk');
        $this->produkModel->save([
            'nama_produk'     => $nama_produk,
            'harga_produk'    => $this->request->getPost('harga_produk'),
            'deskripsi_produk'=> $this->request->getPost('deskripsi_produk'),
            'merk_produk'     => $this->request->getPost('merk_produk'),
            'type_produk'     => $this->request->getPost('type_produk'),
            'tahun_pembuatan' => $this->request->getPost('tahun_pembuatan'),
            'jumlah'          => $this->request->getPost('jumlah'),
            'photo_produk'    => $newName
        ]);

        $db = \Config\Database::connect();
        $db->table('log')->insert([
            'id_user'   => session()->get('id_user'),
            'fullname'  => session()->get('fullname'),
            'activity'  => 'Telah Menambahkan Produk ' . $nama_produk,
            'created_at'=> date('Y-m-d H:i:s')
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

        $nama_produk = $this->request->getPost('nama_produk');
        $this->produkModel->update($id, [
            'nama_produk'     => $nama_produk,
            'harga_produk'    => $this->request->getPost('harga_produk'),
            'deskripsi_produk'=> $this->request->getPost('deskripsi_produk'),
            'merk_produk'     => $this->request->getPost('merk_produk'),
            'type_produk'     => $this->request->getPost('type_produk'),
            'tahun_pembuatan' => $this->request->getPost('tahun_pembuatan'),
            'jumlah'          => $this->request->getPost('jumlah'),
            'photo_produk'    => $newName
        ]);

        $db = \Config\Database::connect();
        $db->table('log')->insert([
            'id_user' => $this->id_user,
            'activity' => 'Telah MenUpdate Produk ' . $nama_produk,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/produk')->with('success', 'Produk berhasil diupdate.');
    }

    public function delete($id)
    {
        $produk = $this->produkModel->find($id);
        if ($produk && $produk['photo_produk'] && file_exists('uploads/' . $produk['photo_produk'])) {
            unlink('uploads/' . $produk['photo_produk']);
        }
        $db = \Config\Database::connect();
        $db->table('log')->insert([
            'id_user' => $this->id_user,
            'activity' => 'Telah Menghapus Produk ' . $produk['nama_produk'],
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $this->produkModel->delete($id);
        return redirect()->to('/produk')->with('success', 'Produk berhasil dihapus.');
    }
}
