<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class HomeController extends Controller
{
    public function index()
    {
        //get catalog from DB
        $items = 4;
        $products = Product::whereNotNull('product_id')->paginate($items);
        return view('home', [
            "products" => $products
        ]);
    }
}
