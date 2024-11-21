<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //get catalog from DB
       
        $products = Product::whereNotNull('product_id')->paginate($this->getCatalogPerPageAmount());

        //$products = $this->filterProducts($request, $products);

        return view('home', [
            "products" => $products
        ]);
    }

    public static function getCatalogPerPageAmount()
    {
        return 30;//dont change this
    } 

    public static function filterProducts(Request $request, $products)
    {

    }
}
