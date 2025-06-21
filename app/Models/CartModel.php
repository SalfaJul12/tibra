<?php

namespace App\Models;
use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';
    protected $allowedFields = ['id_produk','id_user', 'nama_produk', 'harga_produk', 'qty', 'harga_total'];
    public $timestamps = true;
}