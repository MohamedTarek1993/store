<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class CartPageController extends Controller
{
    /**
     * Show the cart page with the products in the cart.
     *
     * @return \Illuminate\Http\Response
     */
    function index() {
       $products = Session::get('cart', []);

        return view('pages.cart' , compact('products'));
    }
   
}
