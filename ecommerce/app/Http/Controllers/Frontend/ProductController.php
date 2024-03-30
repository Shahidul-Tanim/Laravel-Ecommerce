<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function showCategoryProduct($slug){
        $products = Product::whereHas('categories', function($q) use ($slug){
            return $q->where('slug', $slug);
        })->get();
        dd($products);
    }
}
