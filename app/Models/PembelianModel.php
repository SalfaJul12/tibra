<?php

namespace App\Models;
use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $allowedFields = ['id_user', 'id_produk', 'tanggal_pembelian'];

    public function getLaporanPembelian()
    {
        return $this->db->table('pembelian')
            ->select('produk.nama_produk, produk.harga_produk, user.fullname, user.email, pembelian.tanggal_pembelian')
            ->join('produk', 'produk.id_produk = pembelian.id_produk')
            ->join('user', 'user.id_user = pembelian.id_user')
            ->get()
            ->getResultArray();
    }
}
