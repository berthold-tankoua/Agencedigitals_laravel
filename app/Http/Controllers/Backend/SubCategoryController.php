<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\Category;
use Carbon\Carbon;

class SubCategoryController extends Controller
{

    /*===========================================
    SUBCATEGORY PAGE VIEW PAGE
    ===========================================*/

    public function ctrSubCategoryView(){
        $categories = Category::orderBy('category_name_fr','ASC')->get();
        $subcategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_view',compact('subcategories','categories'));
    } //End Method

    /*===========================================
    ADD SUBCATEGORY 
    ===========================================*/

    public function ctrSubCategoryStore(Request $request){

        $request->validate([
         'category_id'=>'required',
         'subcategory_name_fr'=>'required',
        ],[
           'category_id.required'=>'select category',
           'subcategory_name_fr.required'=>'input subcategory french Name',
        ]);

        SubCategory::insert([
           'category_id'=>$request->category_id,
           'subcategory_name_fr'=>$request->subcategory_name_fr,
           'subcategory_slug_fr'=>strtolower(str_replace('','-',$request->subcategory_name_fr)),
        ]);

        $notification = array(
         'message' =>'subcategory Inserted Successfully',
         'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);

    } //End Method

    /*===========================================
    EDIT SUBCATEGORY
    ===========================================*/

    public function ctrSubCategoryEdit($id){
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::orderBy('category_name_fr','ASC')->get();
        return view('backend.subcategory.subcategory_edit',compact('subcategory', 'categories'));
    } //End Method

    /*===========================================
    UPDATE SUBCATEGORY
    ===========================================*/

    public function ctrSubCategoryUpdate(Request $request){
        $subcategory_id = $request->id;

        SubCategory::findOrFail($subcategory_id)->update([
            'category_id'=>$request->category_id,
            'subcategory_slug_fr'=> Str::slug($request->subcategory_name_fr),
            'subcategory_name_fr'=> $request->subcategory_name_fr,
        ]);
 
        $notification = array(
            'message' =>'subcategory Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    } //End Method

    /*===========================================
    DELETE SUBCATEGORY
    ===========================================*/

    public function ctrSubCategoryDelete($id){

        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' =>'Subcategory Deleted Successfully',
            'alert-type'=>'info'
        );

        return redirect()->route('all.subcategory')->with($notification);
    } //End Method

    /*===========================================
    AJAX GET SUBCATEGORY FOR DEPENDENT DROPDOWN 
    ===========================================*/

    public function ctrGetSubCategoryView($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->latest()->get();
        return json_encode($subcat);
    } //End Method
}