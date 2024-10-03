<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class HomeController extends Controller
{
    public function index()
    {
        //get catalog from DB
        $items = 5;
        $products = Product::whereNotNull('name')->paginate($itemsgit a);
        return view('home', [
            "products" => $products
        ]);
    }
}
