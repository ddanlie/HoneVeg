<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductLabelValue;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //get catalog from DB
       

        $products = Product::whereNotNull('product_id');

        $labels = $this->getAllLabelsFromCat(1);

        $products = $this->filterProducts($request, $products, $labels);

        

        return view('home', [
            "products" => $products->paginate($this->getCatalogPerPageAmount()),
            "labels" => $labels
        ]);
    }

    public static function getCatalogPerPageAmount()
    {
        return 30;//dont change this
    }

    public static function getCat1LabelsAmount()
    {
        return 2;
    }

    public static function filterProducts(Request $request, $products, $labels)
    {
        $priceF = $request->input("priceFilter");

        if($priceF)
            $products->where('price', '<=', floatval($priceF));

        $productIds = $products->get()->pluck('product_id')->toArray();

        $pvals = ProductLabelValue::whereIn('product_id', $productIds)->with('label')->get();
        $textPvals = $pvals->filter(function ($pval) {
            return $pval->label && $pval->label->type == 'text';
        });    
        $numberPvals = $pvals->filter(function ($pval) {
            return $pval->label && $pval->label->type == 'number';
        });
        
        
        foreach($labels as $lab)
        {
            $rejectedProdsId = [];
            $labF = $request->input($lab->name.'_'.$lab->label_id);
            if($labF)
            {
                if($lab->type == "number")
                {
                    $numberPvals = $numberPvals->reject(function ($pval) use ($lab, $labF, &$rejectedProdsId) {
                        $rejected = $pval->label_id == $lab->label_id && $pval->label_value > floatval($labF);
                        if($rejected)
                        {
                            array_push($rejectedProdsId, $pval->product_id);
                        }
                        return $rejected;
                    });
                }
                elseif($lab->type == "text")
                {
                    $textPvals = $textPvals->reject(function ($pval) use ($lab, $labF, &$rejectedProdsId) {
                        $rejected = $pval->label_id == $lab->label_id && $pval->label_value != $labF && $labF != "";
                        if($rejected)
                        {
                            array_push($rejectedProdsId, $pval->product_id);
                        }
                        return $rejected;
                    });
                }
                if(count($rejectedProdsId) > 0)
                {
                    $numberPvals = $numberPvals->reject(function ($pval) use ($rejectedProdsId) {
                        return in_array($pval->product_id, $rejectedProdsId);
                    });

                    $textPvals = $textPvals->reject(function ($pval) use ($rejectedProdsId) {
                        return in_array($pval->product_id, $rejectedProdsId);
                    });
                }
            }
        }

        $pids = [];

        $pids = array_merge($pids, $numberPvals->pluck("product_id")->toArray());
        //$pids = array_merge($pids, $textPvals->pluck("product_id")->toArray());
        $products->whereIn("product_id", $pids);

        return $products;
    }

    public static function getAllLabelsFromCat($category_id)
    {
        $labels = [];
        $cats = [];
        $counter = 0;

        $subcats = Category::where("category_id", $category_id)->first()->subcategories()->where("category_id", "!=", $category_id)->get();
        foreach($subcats as $subcat)
        {
            array_push($cats, $subcat);
        }

        while($counter < count($cats))
        {
            foreach($cats[$counter]->labels()->get() as $lbl)
            {
                array_push($labels, $lbl);
            }
            $subcatsArr = $cats[$counter]->subcategories()->get();
            if($subcatsArr)
            {
                foreach($subcatsArr as $subcat)
                {
                    array_push($cats, $subcat);
                }
            }

            $counter++;
        }
        
        return $labels;
    }
}
