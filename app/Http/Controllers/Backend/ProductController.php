<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use  App\Models\Product;
use App\Models\Category;

use App\Models\Store;
use App\Models\MultiImg;
use App\Models\Specification;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{

    private function uploadImage($file, $path){
        $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        $filePath = $path . '/' . $name;
        Image::make($file)->resize(800, 600)->save($filePath);

        return $filePath;
    }
    /*===========================================
    ADD PRODUCT VIEW PAGE
    ===========================================*/

    public function ctrAddProductView() {
        $categories = Category::latest()->get();
        $stores = Store::latest()->get();
        return view('backend.product.product_add', compact('categories', 'stores'));

    } //End Method

    /*===========================================
    VIEW ALL PRODUCTS VIEW PAGE
    ===========================================*/

    public function ctrViewAllProducts() {

        $products = Product::all();

        return view('backend.product.view_all_products', compact('products'));

    } //End Method

    /*===========================================
    STORE PRODUCTS TO THE DATABASE
    ===========================================*/

    public function ctrStoreProduct(Request $request) {

        $thumbnail = $this->uploadImage($request->file('product_thambnail'), 'upload/products/thambnail');

        $video = $request->file('product_video');
        if ($request->file('product_video')) {
            $video_name_gen = hexdec(uniqid()).'.'.$video->getClientOriginalExtension();
            $destinationpath = 'upload/products/videos/';
            $video->move($destinationpath, $video_name_gen);
            $video_save_url = 'upload/products/videos/'.$video_name_gen;
        }else{
            $video_save_url = null;
        }

        $product = Product::create([
            'brand_id'         => null,
            'store_id'         => $request->store_id,
            'category_id'      => $request->category_id,
            'product_name'     => $request->product_name,
            'video_link'       => $request->video_link,
            'product_slug'     => Str::slug($request->product_name),
            'product_code'     => Str::random(8),
            'product_qty'      => $request->product_qty,
            'product_tags'     => $request->product_tags . ',' . str_replace(' ', ',', $request->product_name),
            'product_size'     => $request->product_size,
            'product_color'    => $request->product_color,
            'selling_price'    => $request->selling_price,
            'discount_price'   => $request->discount_price,
            'action_type'      => $request->action_type,
            'short_descp'      => $request->short_descp,
            'long_descp'       => $request->long_descp,
            'top_20'           => $request->top_20,
            'product_thambnail'=> $thumbnail,
            'product_video'=> $video_save_url,
            'status'           => 1,
            'views'            => 0,
            'stock'            => 1,
            'created_at'       => now(),
        ]);

        // Upload multiple images
        if ($request->hasFile('multi_img')) {
            foreach ($request->file('multi_img') as $img) {
                $uploadPath = $this->uploadImage($img, 'upload/products/multi-image');
                MultiImg::create([
                    'product_id' => $product->id,
                    'photo_name' => $uploadPath,
                ]);
            }
        }

        // Insert specifications
        if (!empty($request->spec_title)) {
            foreach ($request->spec_title as $i => $title) {
                Specification::create([
                    'product_id' => $product->id,
                    'spec_title' => $title,
                    'spec_desc'  => $request->spec_desc[$i] ?? '',
                ]);
            }
        }

        $notification = array(
			'message' => 'Produit ajoute avec succès',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);


    } //End Method


    /*===========================================
    EDIT PRODUCT VIEW PAGE
    ===========================================*/
    public function ctrEditProduct($id){

		$categories = Category::latest()->get();
       $stores = Store::latest()->get();
		$product = Product::findOrFail($id);
		return view('backend.product.product_edit',compact('categories','product','stores'));

	}

    /*===========================================
    UPDATE PRODUCT VIEW PAGE
    ===========================================*/
    public function ctrUpdateProduct(Request $request){

        $product = Product::findOrFail($request->id);

        $data = $request->only([
            'product_name', 'video_link', 'product_qty',
            'product_tags', 'product_size', 'product_color',
            'selling_price', 'discount_price', 'long_descp'
        ]);
       
        $data['product_slug'] = Str::slug($request->product_name);
        $data['action_type'] =$request->action_type ?? null;
        if ($request->hasFile('product_thambnail')) {
            if (file_exists($product->product_thambnail)) {
                @unlink($product->product_thambnail);
            }
            $data['product_thambnail'] = $this->uploadImage($request->file('product_thambnail'), 'upload/products/thambnail');
        }

        $product->update($data);

        $notification = array(
            'message' =>'Produit mis à jour avec succès',
            'alert-type'=>'info'
        );

        return redirect()->route('view.all.products')->with($notification);
	}

    /*===========================================
    DELETE PRODUCTS FROM DATABASE
    ===========================================*/

    public function ctrProductDelete($id){

        $product = Product::findOrFail($id);

        if (file_exists($product->product_thambnail)) {
            @unlink($product->product_thambnail);
        }

        Specification::where('product_id', $id)->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $img) {
            if (file_exists($img->photo_name)) {
                @unlink($img->photo_name);
            }
            $img->delete();
        }

        $product->delete();

        $notification = array(
           'message' => 'Produit Supprimé avec succes',
           'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);

    }// end method

    /*===========================================
    ACTIVE Product  PRINCIPAL
    ===========================================*/

    public function ctrProductActive($item_id) {

        Product::findOrFail($item_id)->update(['status' => 1]);

        $notification = array(
            'message' =>'Produit active avec succès',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);


    } //End Method


    /*===========================================
    INACTIVE Product  PRINCIPAL
    ===========================================*/

    public function ctrProductInactive($item_id) {

        Product::findOrFail($item_id)->update(['status' => 0]);

        $notification = array(
            'message' =>'Produit desactive avec succès',
            'alert-type'=>'error'
        );

        return redirect()->back()->with($notification);

    } //End Method
}
