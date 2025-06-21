<?php

namespace App\Controllers;
use App\Models\ProdukModel;
use App\Models\DiskonModel;
use App\Models\UserModel;
use App\Models\PembelianModel;
use App\Models\CartModel;

class Home extends BaseController
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

    public function index(): string
    {
        $data['cart'] = $this->cartModel->where('id_user', $this->id_user)->findAll();
        return view('index', $data);
    }

    public function kategori()
    {
        $produkModel = new ProdukModel();
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $produk = $produkModel->like('nama_produk', $keyword)
                                  ->orLike('merk_produk', $keyword)
                                  ->orLike('type_produk', $keyword)
                                  ->findAll();
        } else {
            $produk = $produkModel->findAll();
        }

        $data = [
            'produk' => $produk,
            'keyword' => $keyword
        ];
        $data['cart'] = $this->cartModel->where('id_user', $this->id_user)->findAll();

        return view('kategori', $data);
    }

    public function about(): string
    {
        return view('about');
    }

    public function detail($id = null): string
    {
        if ($id === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('ID Produk tidak ditemukan.');
        }

        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id);

        if (!$produk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Produk tidak ditemukan.");
        }

        return view('detail', ['produk' => $produk]);
    }

    public function shopnow()
    {
        $id_user = session()->get('id_user');

        if (!$id_user) {
            return redirect()->to('/login')->with('error', 'Silakan login untuk checkout');
        }
            $db = \Config\Database::connect();
            $cartItems = $db->table('cart')
                ->select('cart.*, produk.photo_produk','produk.type_produk')
                ->join('produk', 'cart.id_produk = produk.id_produk')
                ->where('cart.id_user', $id_user)
                ->get()
                ->getResultArray();
        if (empty($cartItems)) {
            return redirect()->to('/')->with('error', 'Keranjang Anda kosong');
        }

        return view('shopnow', ['cartItems' => $cartItems]);
    }

    // public function shopnow($id = null): string
    // {
    //     if ($id === null) {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('ID Produk tidak ditemukan.');
    //     }
        
    //     $cartModel = new \App\Models\CartModel();
    //     $id_user = session()->get('id_user');
    //     $cartItems = $cartModel->where('id_user', $id_user)->findAll();
    //     if (empty($cartItems)) {
    //         return redirect()->to('/')->with('error', 'Keranjang Anda kosong');
    //     }
        
    //     $produkModel = new ProdukModel();
    //     $produk = $produkModel->find($id);

    //     if (!$produk) {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Produk tidak ditemukan.");
    //     }

    //     // Simpan produk ke session untuk digunakan di checkout
    //     session()->set('produk_checkout', $produk);

    //     return view('shopnow', ['produk' => $produk]);
    // }

    // // ✅ Proses setelah klik "Finish Payment"
    // public function finishPayment()
    // {
    //     $produk = session()->get('produk_checkout');

    //     if (!$produk) {
    //         return redirect()->to(base_url('/'))->with('error', 'Produk tidak tersedia di sesi.');
    //     }

    //     // Ambil data dari form
    //     $data = [
    //         'produk' => $produk,
    //         'pengiriman' => $this->request->getPost('shipping'),
    //         'metode_pembayaran' => $this->request->getPost('payment'),
    //         'norek' => $this->request->getPost('norek'),
    //         'nokartu' => $this->request->getPost('nokartu'),
    //         'pin' => $this->request->getPost('pin'),
    //     ];

    //     // Simpan ke session untuk ditampilkan di halaman pengiriman & history
    //     session()->set('last_checkout', $data);

    //     return redirect()->to(base_url('shipping'));
    // }

    // ✅ Halaman pengiriman setelah checkout
    // public function shipping()
    // {
    //     $checkout = session()->get('last_checkout');

    //     if (!$checkout) {
    //         return redirect()->to(base_url('/'))->with('error', 'Tidak ada data pengiriman.');
    //     }

    //     return view('shipping', $checkout); // kirim semua data ke shipping.php
    // }

    // ✅ Halaman riwayat setelah klik "Sudah Diterima"
    public function history()
    {
        $checkout = session()->get('last_checkout');

        if (!$checkout) {
            return redirect()->to(base_url('/'))->with('error', 'Riwayat tidak ditemukan.');
        }

        return view('history', $checkout); // kirim semua data ke history.php
    }

    public function finishPayment()
    {
        $session = session();
        $produk = $session->get('produk_checkout');

        if (!$produk) {
            return redirect()->to(base_url('/'))->with('error', 'Produk tidak tersedia di sesi.');
        }

        // Cek apakah user login
        if (!$session->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data dari form
        $shipping = $this->request->getPost('shipping');
        $payment = $this->request->getPost('payment');
        $norek = $this->request->getPost('norek');
        $nokartu = $this->request->getPost('nokartu');
        $pin = $this->request->getPost('pin');

        // Simpan pembelian ke database
        $pembelianModel = new \App\Models\PembelianModel();
        $pembelianModel->insert([
            'id_user' => $session->get('id_user'),   // pastikan 'id_user' disimpan saat login
            'id_produk' => $produk['id_produk'],     // dari session
            'tanggal_pembelian' => date('Y-m-d H:i:s'),
        ]);

        // Simpan juga ke sesi untuk tampilan shipping
        $session->set('last_checkout', [
            'produk' => $produk,
            'pengiriman' => $shipping,
            'metode_pembayaran' => $payment,
            'norek' => $norek,
            'nokartu' => $nokartu,
            'pin' => $pin
        ]);

        // Clear session produk_checkout karena sudah dibeli
        $session->remove('produk_checkout');

        return redirect()->to(base_url('shipping'))->with('success', 'Pembayaran berhasil.');
    }

    public function shipping()
    {
        $checkout = session()->get('last_checkout');

        if (!$checkout) {
            return redirect()->to(base_url('/'))->with('error', 'Tidak ada data pengiriman.');
        }

        return view('shipping', ['checkout' => $checkout]); // Ini versi final dan benar
    }

    public function cart()
    {
        return view('cart.php');
    }

}
