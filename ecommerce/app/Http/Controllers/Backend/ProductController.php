<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function addProduct(){
        return view('backend.products.addProduct');
    }

    // *STORE
    function storeProduct(Request $request){
        
        $request->validate([
            'title' => 'required|min:15',
            'price' => 'required',
            'brand' => 'required',
        ]);
        return back();
    }
}
