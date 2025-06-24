<?php

namespace App\Controllers;
use App\Models\CartModel;
use App\Models\ProdukModel;

class CartController extends BaseController
{
    protected $cartModel;
    protected $produkModel;
    protected $id_user;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $data['cart'] = $this->cartModel->findAll();
        return view('cart/index', $data);
    }

public function add()
    {
        $id_produk = $this->request->getPost('id_produk');
        $qty = $this->request->getPost('qty');

        if (!$qty || $qty < 1) {
            return redirect()->back()->with('error', 'Qty minimal 1');
        }

        $produk = $this->produkModel->find($id_produk);
        if ($produk) {
            $id_user = session()->get('id_user');

            $existing = $this->cartModel
                ->where('id_produk', $id_produk)
                ->where('id_user', $id_user)
                ->first();

            if ($existing) {
                $newQty = $existing['qty'] + $qty;
                $harga_total = $newQty * $produk['harga_produk'];

                $this->cartModel->update($existing['id_cart'], [
                    'qty' => $newQty,
                    'harga_total' => $harga_total
                ]);
            } else {
                $this->cartModel->save([
                    'id_user' => $id_user, 
                    'id_produk' => $produk['id_produk'],
                    'nama_produk' => $produk['nama_produk'],
                    'harga_produk' => $produk['harga_produk'],
                    'qty' => $qty,
                    'harga_total' => $produk['harga_produk'] * $qty
                ]);
            }
        }

        return redirect()->to('/')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update($id_cart)
    {
        $qty = $this->request->getPost('qty');
        $cartItem = $this->cartModel->find($id_cart);

        if ($cartItem && $qty > 0) {
            $harga_total = $qty * $cartItem['harga_produk'];
            $this->cartModel->update($id_cart, [
                'qty' => $qty,
                'harga_total' => $harga_total
            ]);
        }

        return redirect()->to('/cart');
    }

    public function delete($id_cart)
    {
        $this->cartModel->delete($id_cart);
        return redirect()->to('/');
    }
}
