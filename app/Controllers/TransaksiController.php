<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TransaksiController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if(session()->get('role') !== 'Admin'){
            return redirect()->to('/')->with('error', 'Halaman tidak ditemukan');
        }
        // JOIN checkout dengan users untuk dapat nama & email user
        $builder = $this->db->table('checkout')
            ->select('checkout.*, user.fullname, user.email')
            ->join('user', 'user.id_user = checkout.id_user')
            ->orderBy('checkout.created_at', 'ASC');

        $data['pembelian'] = $builder->get()->getResultArray();

        return view('admin/transaksi', $data);
    }

    public function delete($id)
        {
            // Hapus transaksi dari tabel checkout
            $this->db->table('checkout')->where('id', $id)->delete();

            // Redirect balik ke halaman transaksi dengan flash message (opsional)
            return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil dihapus.');
        }

        

}
