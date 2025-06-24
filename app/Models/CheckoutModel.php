<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckoutModel extends Model
{
    protected $table = 'checkout'; // nama tabel di database
    protected $primaryKey = 'id';  // kolom primary key

    protected $allowedFields = [
        'id_user',
        'cartItems',
        'metode_pembayaran',
        'pengiriman'
    ];

    // Kalau mau auto timestamps (created_at, updated_at)
    // protected $useTimestamps = true;
}
