<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductPageController extends Controller
{
    public function index($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();

        return view('productPage', ['product' => $product]);
    }
}
