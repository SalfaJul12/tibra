<?php

namespace App\Models;

use CodeIgniter\Model;

class DiskonModel extends Model
{
    protected $table = 'diskon';
    protected $primaryKey = 'id_diskon';
    protected $allowedFields = ['id_produk', 'diskon', 'harga_akhir'];
    protected $useTimestamps = false;

    public function getDiskonWithProduk()
    {
        return $this->db->table('diskon')
            ->select('diskon.*, produk.nama_produk, produk.harga_produk')
            ->join('produk', 'produk.id_produk = diskon.id_produk', 'left')
            ->get()->getResultArray();
    }
}
