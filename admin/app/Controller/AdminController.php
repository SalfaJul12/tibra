<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function index(): string
    {
        return view('Admin/index.php');
    }

    public function produk(): string
    {
        return view('Admin/produk.php');
    }

    public function diskon(): string
    {
        return view('Admin/discount.php');
    }

    public function user(): string
    {
        return view('Admin/user.php');
    }
}
