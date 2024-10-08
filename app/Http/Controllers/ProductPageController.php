<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProductList;
use App\Models\SellerOrders;
use App\Models\Label;
use App\Models\ProductLabelValue;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductPageController extends Controller  
{
    public function index($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();

        if(!$product)
        {
            return redirect()->route("categories.index");
        }

        $labelValues = DB::table('products')
        ->where('products.product_id', '=', $product_id)
        ->join('product_label_values', 'products.product_id', '=', 'product_label_values.product_id')
        ->join('labels', 'product_label_values.label_id', '=', 'labels.label_id');

        if($labelValues)//has to be alway true
        {
            $labelValues = $labelValues->pluck('label_value', 'labels.name')->toArray();
        }

        $mainLabelValues = [];
        $mainLabelValues['price type'] = $labelValues['price type'];
        unset($labelValues['price type']);

        


        return view('productPage', [
            'product' => $product,
            'product_exinfo' => [
                'mainLabels' => $mainLabelValues,
                'labels' => $labelValues,
                'categoryName' => Category::where('category_id', $product->category_id)->first()->name,
                'seller' => User::where('user_id', $product->seller_user_id)->first()->name,
                'events' => $product->events()->get()
            ]       
        ]);
    }

    public function store(Request $request, $product_id)
    {
        $redirection = redirect()->route("product.index", ['product_id' => $product_id]);
        
        $product = Product::where("product_id", $product_id)->first();
        
        if($product->available_amount <= 0)
        {
            return $redirection->with('message', 'This product is not for delivery, check events with this product below');
        }
    
        $validated = $request->validate([
            "put_to_order" => ["required", "numeric", "gt:0", "lte:{$product->available_amount}"]
        ]);
        $amountToOrder = intval($validated['put_to_order']);
        
        DB::transaction(function () use ($product, $amountToOrder) {
            $order = Order::where([["status", "=", "cart"], ["customer_user_id", Auth::user()->user_id]])->first();
            if(!$order)
            {
                $order = new Order();
                $order->customer_user_id = Auth::user()->user_id;
                $order->creation_date = now();
                $order->status = "cart";
                $order->save();
            }

            $oplist = OrderProductList::where([["order_id", $order->order_id], ["product_id", $product->product_id]])->first();
            if(!$oplist)
            {
                $oplist = new OrderProductList();
                $oplist->order_id = $order->order_id;
                $oplist->product_id = $product->product_id;
                $oplist->product_amount = $amountToOrder;
            }
            else
            {
                $oplist->product_amount += $amountToOrder;
            }
            $oplist->save();


            $sellerOrder = new SellerOrders();
            $sellerOrder->order_id = $order->order_id;
            $sellerOrder->seller_id = $product->seller_user_id;
            $sellerOrder->save();

            $product->available_amount -= $amountToOrder;
            $product->save();
        });


        return $redirection->with('message', 'Added to cart, check your profile');
    }
}
