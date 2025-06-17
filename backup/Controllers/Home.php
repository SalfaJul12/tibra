<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }

    public function kategori(): string
    {
        return view('kategori');
    }

    public function about(): string
    {
        return view('about');
    }

    public function detail(): string
    {
        return view('detail');
    }

    public function shopnow(): string
    {
        return view('shopnow.php');
    }
}
