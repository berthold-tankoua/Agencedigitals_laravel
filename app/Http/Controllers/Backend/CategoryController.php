<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Image;


class CategoryController extends Controller
{
    /*===========================================
    CATEGORY PAGE VIEW PAGE
    ===========================================*/

    public function ctrCategoryView()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    } //End Method

    /*===========================================
    ADD CATEGORY
    ===========================================*/

    public function ctrCategoryStore(Request $request)
    {

        $request->validate([
            'category_name_fr' => 'required',
        ], [
            'category_name_fr.required' => 'Input category french name',
        ]);

        if ($request->file('category_image')) {

            $category_image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $category_image->getClientOriginalExtension();
            Image::make($category_image)->fit(256, 256)->save('upload/categories/' . $name_gen);
            $save_url = 'upload/categories/' . $name_gen;

            Category::insert([
                'category_name_fr' => $request->category_name_fr,
                'category_slug_fr' => strtolower(str_replace(' ', '-', $request->category_name_fr)),
                'category_image' => $save_url,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Categorie insérer avec succès',
                'alert-type' => 'success'
            );
        } else {
            Category::insert([
                'category_name_fr' => $request->category_name_fr,
                'category_slug_fr' => strtolower(str_replace(' ', '-', $request->category_name_fr)),
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Categorie insérer avec succès',
                'alert-type' => 'success'
            );
        }

        return redirect()->back()->with($notification);
    } //End Method

    /*===========================================
    EDIT CATEGORY
    ===========================================*/

    public function ctrCategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    } //End Method

    /*===========================================
    UPDAPTE CATEGORY
    ===========================================*/

    public function ctrCategoryUpdate(Request $request)
    {

        $category_id = $request->id;
        $old_img = $request->old_img;

        $update_category = Category::findorFail($category_id);
        $update_category->category_name_fr = $request->category_name_fr;
        $update_category->category_icon = $request->category_icon;
        $update_category->category_slug_fr = strtolower(str_replace(' ', '-', $request->category_name_fr));

        if ($request->file('category_image')) {
            @unlink($old_img);
            $category_image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $category_image->getClientOriginalExtension();
            Image::make($category_image)->fit(256, 256)->save('upload/categories/' . $name_gen, 75);
            $save_url = 'upload/categories/' . $name_gen;
            $update_category['category_image'] = $save_url;
        }

        $update_category->save();

        $notification = array(
            'message' => 'Categorie Mise a jour Succes',
            'alert-type' => 'info'
        );

        return redirect()->route('all.category')->with($notification);
    } //End Method

    /*===========================================
    DELETE CATEGORY
    ===========================================*/

    public function ctrCategoryDelete($id)
    {
        $delete_category = Category::findOrFail($id);
        $cat_img = $delete_category->category_image;
        @unlink($cat_img);
        $delete_category->delete();

        $notification = array(
            'message' => 'Categorie supprime avec Succes',
            'alert-type' => 'error'
        );

        return redirect()->route('all.category')->with($notification);
    } //End Method
}
