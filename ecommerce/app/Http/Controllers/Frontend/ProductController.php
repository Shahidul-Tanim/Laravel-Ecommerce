<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function showCategoryProduct($slug)
    {
        $category = Category::select('id', 'category')->where('slug', $slug)->first();
        
        $products = Product::with(['galleries' => function($query){
            return $query->select('id','product_id','title')->first();
        }])
        ->whereHas('categories', function($q) use ($slug){
            return $q->where('slug', $slug);
        })->where('status', true)->select('id','title','slug','featured_img','price','selling_price','status')->get();
        // dd($products);
        return view('frontend.categoryArchive', compact('products', 'category'));
    }

    function showProduct($slug)
    {
        $product = Product::with(['galleries', 'reviews.user'])->where('slug', $slug)->first();
        
        return view('frontend.single-product', compact('product'));
    }
    function searchProduct(Request $request) {
        $search= $request->search;

        

        $products = Product::where('title', 'LIKE', '%'. $search .'%')->take(2)->get();
        $count = Product::where('title', 'LIKE', '%'. $search .'%')->count();

        return response()->json([
            'products' => $products,
            'productCount' => $count,
        ]);
    }
}
