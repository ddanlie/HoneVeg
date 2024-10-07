<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $items = 20;
        $categories = Category::where('category_id', 1)->paginate($items);
        
        return view('categories', ['categories' => $categories]);
    }


    public function show($nameHierarchy)
    {
        $nameHierarchy = explode('/', $nameHierarchy);
        $mainCategory = Category::where('name', end($nameHierarchy))->first();
        $subcategories = $mainCategory->subCategories()->where('category_id', '!=', $mainCategory->category_id)->get();
        $products = $mainCategory->products()->paginate(HomeController::getCatalogPerPageAmount());

        return view('subCategories', [
            'hierarchy' => $nameHierarchy, 
            'subcategories' => $subcategories, 
            'categoryProducts' => $products]);
    }
}
