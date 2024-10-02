<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class HomeController extends Controller
{
    public function index()
    {
        //get catalog from DB
        $products = Product::whereNotNull('name')->paginate(20);
        return view('home', [
            "products" => $products
        ]);
    }
}
