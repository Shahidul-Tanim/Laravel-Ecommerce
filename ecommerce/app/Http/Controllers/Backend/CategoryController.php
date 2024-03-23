<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\MediaUploader;
use App\Helpers\SlugGenerator;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    use SlugGenerator,MediaUploader;

    function category(){

        $categories = Category::with('subcategories.subcategories')->latest()->paginate(30);

        $parentCategories = $categories->where('category_id', null)->flatten();
      
        return view('backend.category.category', compact('categories', 'parentCategories')) ;
    }

    // STORE DATA

    function categoryInsert(Request $request){

        $request->validate([
            'icon'=> "mimes:png,jpg,jpeg"
        ]);

       $slug = $this->createSlug(category::class,$request->category );
       if($request->hasFile('icon')){

           $iconPath = $this->uploadSingleMedia($request->icon,$slug,'category');
       }
       $storeCategory = new Category();
       $storeCategory->category = $request->category;
       $storeCategory->category_id = $request->category_id;
       $storeCategory->category_slug = $slug;
       $storeCategory->icon = $request->hasFile('icon') ? $iconPath : null;
       $storeCategory->save();
       return back();
    }

    // EDIT DATA

    function categoryEdit($id){
       $categories = Category::with('subcategories.subcategories')->latest()->paginate(30);

       $parentCategories = $categories->where('category_id', null)->flatten();
       $findCategory = $categories->where('id', $id)->first();
        
       return view('backend.category.category', compact('categories', 'findCategory', 'parentCategories')) ;
    }

    // UPDATE DATA

    function categoryUpdate(Request $request, $id){

        $slug = $this->createSlug(category::class,$request->category );
        if($request->hasFile('icon')){
 
            $iconPath = $this->uploadSingleMedia($request->icon,$slug,'category', $request->old);
        }
        $storeCategory = Category::find($id);
        $storeCategory->category = $request->category;
        $storeCategory->category_id = $request->category_id;
        $storeCategory->category_slug = $slug;
        $storeCategory->icon = $request->hasFile('icon') ? $iconPath : null;
        $storeCategory->save();
        return back();
        // dd($updateCategory);
    }

    // DELETE DATA

    function categoryDelete($id){
        Category::find($id)->delete();
        return redirect()->route('category');
    }
}
