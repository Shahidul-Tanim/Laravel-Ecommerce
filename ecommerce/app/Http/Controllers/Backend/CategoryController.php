<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SlugGenerator;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    use SlugGenerator;

    function category(){
        $categories = Category::with('subcategories.subcategories')->latest()->paginate(30);

        $parentCategories = $categories->where('category_id', null)->flatten();
      
        return view('backend.category.category', compact('categories', 'parentCategories')) ;
    }

    // STORE DATA

    function categoryInsert(Request $request){

       $slug = $this->createSlug(category::class,$request->category );
       $storeCategory = new Category();
       $storeCategory->category = $request->category;
       $storeCategory->category_id = $request->category_id;
       $storeCategory->category_slug = $slug;
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
