<?php

namespace App\Controllers;
use App\Models\ProdukModel;
use App\Models\DiskonModel;
use App\Models\UserModel;
use App\Models\PembelianModel;
use App\Models\CartModel;
use App\Models\CheckoutModel;


class Home extends BaseController
{
    protected $produkModel;
    protected $diskonModel;
    protected $userModel;
    protected $cartModel;
    protected $id_user;
     protected $checkoutModel;

    public function __construct()
    {
        $this->produkModel = new \App\Models\ProdukModel();
        $this->diskonModel = new DiskonModel();
        $this->userModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->checkoutModel = new CheckoutModel();
        helper(['form', 'url']);
        $this->id_user = session()->get('id_user');
    }

    public function index(): string
    {
        $data['cart'] = $this->cartModel->where('id_user', $this->id_user)->findAll();
        
        $produkModel = new \App\Models\ProdukModel();
        
             
        $data['produkTerbatas'] = $produkModel
            ->where('jumlah <', 10)
            ->findAll();

       
        $data['produk'] = $produkModel->findAll();  
    
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


public function history()
{
    $checkout = session()->get('last_checkout');

    if (!$checkout) {
        return redirect()->to(base_url('/'))->with('error', 'Riwayat tidak ditemukan.');
    }

    // WAJIB PAKAI ['checkout' => $checkout]
    return view('history', ['checkout' => $checkout]);
}




    public function cart()
    {
        return view('cart.php');
    }

public function shopnow()
{
    $id_user = session()->get('id_user');

    if (!$id_user) {
        return redirect()->to('/login')->with('error', 'Silakan login untuk checkout');
    }

    $db = \Config\Database::connect();

    // Ambil cart + detail produk
    $cartItems = $db->table('cart')
        ->select('cart.id_cart, cart.id_user, cart.id_produk, cart.qty, produk.nama_produk, produk.photo_produk, produk.type_produk, produk.harga_produk')
        ->join('produk', 'cart.id_produk = produk.id_produk')
        ->where('cart.id_user', $id_user)
        ->get()
        ->getResultArray();

    if (empty($cartItems)) {
        return redirect()->to('/')->with('error', 'Keranjang Anda kosong');
    }

    // Tambah field harga_total per item
    foreach ($cartItems as &$item) {
        $item['harga_total'] = $item['qty'] * $item['harga_produk'];
    }

    return view('shopnow', [
        'cartItems' => $cartItems
    ]);
}






public function finishPayment()
{
    $session = session();
    $id_user = $session->get('id_user');

    // Ambil semua barang di keranjang user
    $cartItems = $this->cartModel->where('id_user', $id_user)->findAll();

    foreach ($cartItems as &$item) {
        $produk = $this->produkModel->find($item['id_produk']);

        // Lengkapi detail
        $item['photo_produk'] = $produk['photo_produk'];
        $item['nama_produk'] = $produk['nama_produk'];
        $item['harga_produk'] = $produk['harga_produk'];

        // 1️⃣ UPDATE STOK PRODUK
        $newQty = $produk['jumlah'] - $item['qty'];
        if ($newQty < 0) $newQty = 0;

        $this->produkModel->update($item['id_produk'], [
            'jumlah' => $newQty
        ]);
    }

    // Simpan checkout
    $this->checkoutModel->insert([
        'id_user' => $id_user,
        'cartItems' => json_encode($cartItems),
        'pengiriman' => $this->request->getPost('shipping'),
        'metode_pembayaran' => $this->request->getPost('payment')
    ]);

    // Kosongkan keranjang
    $this->cartModel->where('id_user', $id_user)->delete();

    // Redirect
    return view('shipping', ['checkout' => [
        'cartItems' => $cartItems,
        'pengiriman' => $this->request->getPost('shipping'),
        'metode_pembayaran' => $this->request->getPost('payment')
    ]]);
}



    public function shipping()
    {
        $session = session();
        $id_user = $session->get('id_user');

        // Ambil checkout terbaru user ini
        $checkout = $this->checkoutModel
            ->where('id_user', $id_user)
            ->orderBy('id', 'DESC')
            ->first();

        // Decode cartItems JSON jadi array
        $checkout['cartItems'] = json_decode($checkout['cartItems'], true);

        return view('shipping', ['checkout' => $checkout]);
    }
}