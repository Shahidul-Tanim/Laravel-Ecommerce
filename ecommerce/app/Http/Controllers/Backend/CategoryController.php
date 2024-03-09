<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    function category(){
        $categories = Category::latest()->paginate(5);
        // dd($categories);
        return view('backend.category.category', compact('categories')) ;
    }

    // STORE DATA

    function categoryInsert(Request $request){
       $storeCategory = new Category();
       $storeCategory->category = $request->category;
       $storeCategory->category_slug = Str::slug($request->category);
       $storeCategory->save();
       return back();
    }

    // EDIT DATA

    function categoryEdit($id){
        $categories = Category::latest()->get();
        $findCategory = Category::find($id);
        // dd($findCategory);
        return view('backend.category.category', compact('categories', 'findCategory')) ;
    }

    // UPDATE DATA

    function categoryUpdate(Request $request, $id){
        $updateCategory = Category::find($id);
        $updateCategory->category =  $request->category;
        $updateCategory->category_slug = Str::slug($request->category);
        $updateCategory->save();
        return back();
        // dd($updateCategory);
    }

    // DELETE DATA

    function categoryDelete($id){
        Category::find($id)->delete();
        return back();
    }
}
