<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $items = 3;
        $categories = Category::whereColumn('category_id', 'parent_category_id')->paginate($items);
        
        return view('categories', ['categories' => $categories]);
    }


    public function show($nameHierarchy)
    {
        $nameHierarchy = explode('/', $nameHierarchy);
        $mainCategory = Category::where('name', end($nameHierarchy))->first();
        $subcategories = $mainCategory->subCategories()->where('category_id', '!=', $mainCategory->category_id)->get();
        $products = $mainCategory->products()->paginate(3);

        return view('subCategories', [
            'hierarchy' => $nameHierarchy, 
            'subcategories' => $subcategories, 
            'categoryProducts' => $products]);
    }
}
