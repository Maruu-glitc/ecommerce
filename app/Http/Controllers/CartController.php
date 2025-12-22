<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
        return view('cart.index', compact('cart'));
    }

    public function add()
    {
        
    }

    public function update()
    {
        return view('cart.update');
    }

    public function remove()
    {
        return view('cart.remove');
    }
}
