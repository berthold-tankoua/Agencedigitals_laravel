<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Store;
use App\Models\SocialNetwork;
use App\Models\User;
use App\Models\service;
use Carbon\Carbon;
use App\Models\gallery;
use Image;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    
    /*===========================================
    BECOME VENDOR PAGE VIEW PAGE
    ===========================================*/

    public function ctrBecomeVendorView(){

        $notification = array(
            'message' =>'Please Login or Register First',
            'alert-type'=>'info'
        );

        if(Auth::check()){
            return view('frontend.pages.vendor.become_vendor'); 
        }else{
            return redirect()->back()->with($notification);
        }

    } //End Method

    /*===========================================
    STORE LIST VENDOR PAGE VIEW PAGE
    ===========================================*/

    public function ctrStoreListVendorView(){
        if(Auth::check() && Auth::user()->user_role == 'seller'){
            $stores = Store::latest()->where('user_id',Auth::user()->id)->get();
            return view('frontend.pages.vendor.store_list',compact('stores'));
        }
        // else{
        //     return redirect()->route('user.login');
        // }
 

    } //End Method

    
    /*===========================================
    SERVICE VENDOR ACCOUNT VIEW PAGE
    ===========================================*/

    public function ctrStoreAccountView($id,$slug){
        $store_id=$id;
        $store_slug=$slug;
        $products = Product::latest()->where('store_id',$id)->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
		$brands = Brand::latest()->get();
        $stores = Store::where('id',$id)->get();
        return view('frontend.pages.vendor.store_account',compact('products','categories','subcategories','brands','store_id','store_slug','stores')); 

    } //End Method
    
    /*===========================================
    SERVICE VENDOR ACCOUNT VIEW PAGE
    ===========================================*/

    public function ctrServiceAccountView($id,$slug){
        $store_id=$id;
        $store_slug=$slug;
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
		$brands = Brand::latest()->get();
        $stores = Store::where('id',$id)->get();
        foreach($stores as $store){ $services = Service::where('user_id',$store->user_id)->latest()->get(); }
        return view('frontend.pages.vendor.service_account',compact('services','categories','subcategories','brands','store_id','store_slug','stores')); 

    } //End Method


    public function ctrVendorAddProductView($id,$slug){
        $store_id=$id;
        $store_slug=$slug;
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
		$brands = Brand::latest()->get();
        $stores = Store::where('id',$id)->get();
        $products = Product::latest()->where('store_id',$id)->get();
        return view('frontend.pages.vendor.add_product',compact('products','store_id','store_slug','categories','subcategories','brands','stores')); 

    } //End Method

    public function ctrVendorAddServiceView($id,$slug){
        $store_id=$id;
        $store_slug=$slug;
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
		$brands = Brand::latest()->get();
        $stores = Store::where('id',$id)->get();
        $products = Product::latest()->where('store_id',$id)->get();
        return view('frontend.pages.vendor.add_service',compact('products','store_id','store_slug','categories','subcategories','brands','stores')); 

    } //End Method

    public function GaleryStore(Request $request){
        $request->validate([
         'galery_name_en'=>'required',
         'galery_name_fr'=>'required',
         'service_price'=>'required',
         'galery_image'=>'required',
        ],[
           'galery_name_en.required'=>'Input category english name',
           'galery_name_fr.required'=>'Input category french name',
           'galery_image.required'=>'Input galery_image',
        ]);

        if($request->file('galery_image')){
            $galery_image = $request->file('galery_image');
            $name_gen = hexdec(uniqid()).'.'.$galery_image->getClientOriginalExtension();
            Image::make($galery_image)->save('upload/galery/'.$name_gen);
            $save_url = 'upload/galery/'.$name_gen;

            gallery::insert([

                'store_id' => $request->store_id,
                'galery_name_en' => $request->galery_name_en,
                'galery_name_fr' => $request->galery_name_fr,
                'service_price'=> $request->service_price,
                'galery_image'=> $save_url,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' =>'galery Inserted Successfully',
                'alert-type'=>'success'
            );

        }

        return redirect()->back()->with($notification);

    } //End Method


    public function StoreAccountRegister(){
        return view('frontend.pages.vendor.create_P_account'); 
    }
    public function ServiceAccountRegister(){
        return view('frontend.pages.vendor.create_S_account'); 
    }

    /*===========================================
    STORE ACCOUNT TO THE DATABASE
    ===========================================*/

    public function StoreAccountSave(Request $request) {
        

        User::where('id',$request->user_id)->update(['user_role' => 'seller']);

        $image = $request->file('store_thambnail');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->fit(300,300 )->save('upload/stores/thambnail/'.$name_gen);
    	$save_url1 = 'upload/stores/thambnail/'.$name_gen;

        $image1 = $request->file('store_verif');
        if(!empty($image1)){
            $name_gen1 = hexdec(uniqid()).'.'.$image1->getClientOriginalExtension();
            Image::make($image1)->fit(300,300 )->save('upload/stores/verification/'.$name_gen1);
            $save_url2 = 'upload/stores/verification/'.$name_gen1;
        }else{
            $save_url2 = 'null';
        }


        $store_id = Store::insertGetId([
            'user_id' => $request->user_id,
            'store_name' => $request->store_name,
            'store_name_slug' => Str::slug($request->store_name),
            'store_adress' => $request->store_adress,
            'store_contact' => $request->store_contact,
            'store_email' => $request->store_email,
            'store_descp_en' => $request->store_descp_en,
            'store_descp_fr' => $request->store_descp_fr,
            'store_thambnail' => $save_url1,
            'store_verif' => $save_url2,
            'type' => $request->type,
            'status' => 1,
            'type' => 1,
            'raiting' => 5,
            'created_at' => Carbon::now(),  
            'expiry_date' => Carbon::now()->addDay(31),	 
  
        ]);


        ////////// Add Multiples Specifications Start ///////////

        $count_spec_title = count($request->spec_title);

        if($count_spec_title != NULL){

            for($i = 0; $i < $count_spec_title; $i++) {

                SocialNetwork::insert([

                    'store_id' => $store_id,
                    'network_name' => $request->spec_title[$i],
                    'network_link' => $request->spec_desc[$i],
                    'created_at' => Carbon::now()

                ]);

            }
        }

        $notification = array(
			'message' => 'Store Created Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('store-list.view')->with($notification);


    } //End Method


}
