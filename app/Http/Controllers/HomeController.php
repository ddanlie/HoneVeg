<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class HomeController extends Controller
{
    public function index()
    {
        //get catalog from DB
       
        $products = Product::whereNotNull('product_id')->paginate($this->getCatalogPerPageAmount());
        return view('home', [
            "products" => $products
        ]);
    }

    public static function getCatalogPerPageAmount()
    {
        return 30;//dont change this
    } 
}
