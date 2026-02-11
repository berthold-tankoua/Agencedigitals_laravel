<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class DeliveryController extends Controller
{
    //
    public function ctrViewAlldeliverys() {

        $delivers = Delivery::withCount(['orders'])->latest()->get();

        return view('backend.delivery.view_all_delivers', compact('delivers'));

    } //End Method


    public function ctrAdddeliveryView() {

        $users = User::where('role','user')->get();

        return view('backend.delivery.delivery_add', compact('users'));

    } //End Method

    public function ctrsavedelivery(Request $request) {

        $request->validate([
            'name'=>'required',
            'adress'=>'required',
            'contact'=>'required',
            'email'=>'required',
            'image'=>'required',
           ],[
              'name.required'=>'Saisir le nom ',
              'adress.required'=>'Saisir l adresse ',
              'contact.required'=>'Saisir le contact ',
              'email.required'=>'Saisir l email ',
              'image.required'=>'Inserer votre photo de profil',
           ]);

        $image = $request->file('image');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->fit(600,600)->save('upload/deliveries/'.$name_gen);
    	$save_url = 'upload/deliveries/'.$name_gen;


        Delivery::insertGetId([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'name_slug' => Str::slug($request->name),
            'adress' => $request->adress,
            'phone' => $request->contact,
            'email' => $request->email,
            'descp' => $request->descp,
            'image' => $save_url,
            'status' => 'available',
            'created_at' => Carbon::now(),
        ]);
            User::findOrfail($request->user_id)->update([
                'role' => 'deliver',
            ]);

        $notification = array(
			'message' => 'Livreur Inserer avec Succes',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);


    } //End Method


    /*===========================================
    EDIT DELIVERY VIEW PAGE
    ===========================================*/
    public function ctrEditdelivery($id){

		$delivery = Delivery::findOrFail($id);
		return view('backend.delivery.delivery_edit',compact('delivery'));

	}

        public function ctrUpdatedelivery(Request $request){
        $store = Delivery::findOrFail($request->id);

        // Validation basique
        $request->validate([
            'name'       => 'required|string|max:255',
            'contact'    => 'nullable|string|max:50',
            'email'      => 'nullable|email',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Préparer les données communes
        $data = [
            'name'       => $request->name,
            'name_slug'  => Str::slug($request->name),
            'adress'     => $request->adress,
            'phone'    => $request->contact,
            'email'      => $request->email,
            'descp'   => $request->descp,
        ];

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_url = 'upload/deliveries/'.$name_gen;

            // Sauvegarde avec intervention
            Image::make($image)->fit(600,600)->save(public_path($save_url));

            // Supprimer l’ancienne image si existe
            if ($request->old_img && file_exists(public_path($request->old_img))) {
                @unlink(public_path($request->old_img));
            }

            $data['image'] = $save_url;
        }

        // Mise à jour du store
        $store->update($data);

        // Notification
        return redirect()->back()->with([
            'message'    => 'Mise à jour effectuée avec succès',
            'alert-type' => 'info',
        ]);
    }

    public function ctrdeliveryOrders($id){
        $delivery = Delivery::findOrFail($id);
		$orders = Order::where('delivery_id',$id)->orderBy('id','DESC')->get();
		return view('backend.delivery.delivery_orders',compact('orders','delivery'));

	} // end mehtod

}
