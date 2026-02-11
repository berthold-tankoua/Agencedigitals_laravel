<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Store;
use App\Models\Order;
use App\Models\SocialNetwork;
use Carbon\Carbon;

use App\Models\User;

use App\Services\ProductService;
use Image;

class StoreController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){

        $this->productService = $productService;

    }
    /*===========================================
    ADD STORE VIEW PAGE
    ===========================================*/

    public function ctrAddStoreView() {

        $users = User::where('role','user')->get();

        return view('backend.store.store_add', compact('users'));

    } //End Method

    /*===========================================
    VIEW ALL STORES VIEW PAGE
    ===========================================*/

    public function ctrViewAllStores() {

        $stores = Store::withCount(['products'])->latest()->get();

        return view('backend.store.view_all_stores', compact('stores'));

    } //End Method

    /*===========================================
    STORE STORES TO THE DATABASE
    ===========================================*/

    public function ctrStoreStore(Request $request) {

        $request->validate([
            'store_name'=>'required',
            'store_adress'=>'required',
            'store_contact'=>'required',
            'store_email'=>'required',
            'store_thambnail'=>'required',
           ],[
              'store_name.required'=>'Saisir le nom de la compagnie',
              'store_adress.required'=>'Saisir l adresse de votre agence',
              'store_contact.required'=>'Saisir le contact de votre agence',
              'store_email.required'=>'Saisir l email de votre agence',
              'store_thambnail.required'=>'Inserer votre photo de profil',
           ]);

        $image = $request->file('store_thambnail');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->fit(600,600)->save('upload/stores/thambnail/'.$name_gen);
    	$save_url = 'upload/stores/thambnail/'.$name_gen;


        $store_id = Store::insertGetId([
            'user_id' => $request->user_id,

            'store_name' => $request->store_name,

            'store_name_slug' => Str::slug($request->store_name),
            'store_adress' => $request->store_adress,
            'store_contact' => $request->indicatif.$request->store_contact,
            'store_email' => $request->store_email,
            'store_descp_fr' => $request->store_descp_fr,
            'store_thambnail' => $save_url,
            'status' => 1,
            'raiting' => 5,
            'created_at' => Carbon::now(),
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
			'message' => 'Compagnie Inserer avec Succes',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);


    } //End Method


    /*===========================================
    EDIT STORE VIEW PAGE
    ===========================================*/
    public function ctrEditStore($id){

		$store = Store::findOrFail($id);
		return view('backend.store.store_edit',compact('store'));

	}
     /*===========================================
    UPDATESTORES TO THE DATABASE
    ===========================================*/

    public function ctrUpdateStore(Request $request){
        $store = Store::findOrFail($request->id);

        // Validation basique
        $request->validate([
            'store_name'       => 'required|string|max:255',
            'store_contact'    => 'nullable|string|max:50',
            'store_email'      => 'nullable|email',
            'store_thambnail'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Préparer les données communes
        $data = [
            'store_name'       => $request->store_name,
            'store_name_slug'  => Str::slug($request->store_name),
            'store_adress'     => $request->store_adress,
            'store_contact'    => $request->store_contact,
            'store_email'      => $request->store_email,
            'store_descp_fr'   => $request->store_descp_fr,
            'raiting'          => 5,
        ];

        // Gestion de l'image
        if ($request->hasFile('store_thambnail')) {
            $image = $request->file('store_thambnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_url = 'upload/stores/thambnail/'.$name_gen;

            // Sauvegarde avec intervention/image
            Image::make($image)->fit(600,600)->save(public_path($save_url));

            // Supprimer l’ancienne image si existe
            if ($request->old_img && file_exists(public_path($request->old_img))) {
                @unlink(public_path($request->old_img));
            }

            $data['store_thambnail'] = $save_url;
        }

        // Mise à jour du store
        $store->update($data);

        // Gestion des réseaux sociaux
        if ($request->spec_title && is_array($request->spec_title)) {
            SocialNetwork::where('store_id', $store->id)->delete();

            foreach ($request->spec_title as $i => $title) {
                SocialNetwork::create([
                    'store_id'     => $store->id,
                    'network_name' => $title,
                    'network_link' => $request->spec_desc[$i] ?? null,
                    'created_at'   => Carbon::now(),
                ]);
            }
        }

        // Notification
        return redirect()->back()->with([
            'message'    => 'Mise à jour effectuée avec succès',
            'alert-type' => 'info',
        ]);
    }


    /*===========================================
    DELETE STORES FROM DATABASE
    ===========================================*/

    public function ctrStoreDelete($store_id){
        $store = Store::findOrFail($store_id);

        if ($store->store_thambnail && file_exists(public_path($store->store_thambnail))) {
          @unlink(public_path($store->store_thambnail));
        }
        $store->delete();
        SocialNetwork::where('store_id',$store_id)->delete();

        Product::findOrfail($store->id)->update([
            'store_id' => null,
        ]);
        $notification = array(
           'message' => 'La compagnie a ete bien été supprimée',
           'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }// end method

    /*===========================================
    ACTIVE Store  PRINCIPAL
    ===========================================*/

    public function ctrStoreActive($item_id) {

            Store::findOrFail($item_id)->update([
                'status' => 1,
            ]);



         $notification = array(
            'message' =>'Compagnie active avec Succes',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);


    } //End Method


    /*===========================================
    INACTIVE Store  PRINCIPAL
    ===========================================*/

    public function ctrStoreInactive($item_id) {

        Store::findOrFail($item_id)->update(['status' => 0]);
        Product::where('store_id',$item_id)->update([
            'status' => 0,
        ]);

        $notification = array(
            'message' =>'Compagnie desactive avec Succes',
            'alert-type'=>'error'
        );

        return redirect()->back()->with($notification);

    } //End Method



    public function ctrAllStoreActive() {

        $stores = Store::get();
        foreach ($stores as $store) {
            Store::where('id',$store->id)->update([
                'status' => 1,
                'expiry_date' => Carbon::now()->addDay(90),
            ]);

            Product::where('store_id',$store->id)->update(['status' => 1]);

        }

        $notification = array(
            'message' =>'Toutes les compagnie ont ete activees avec Succes',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);


    } //End Method


    /*===========================================
    INACTIVE Store  PRINCIPAL
    ===========================================*/

    public function ctrAllStoreInactive() {

        $stores = Store::all();
        foreach ($stores as $store) {
            Store::where('id',$store->id)->update(['status' => 0]);
            Product::where('store_id',$store->id)->update(['status' => 0]);
        }

        $notification = array(
            'message' =>'Toutes les compagnies ont ete desactivees avec Succes',
            'alert-type'=>'error'
        );

        return redirect()->back()->with($notification);

    } //End Method

}
