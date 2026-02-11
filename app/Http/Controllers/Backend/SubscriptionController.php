<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use  App\Models\Property;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /*===========================================
    Abonnement PAGE VIEW PAGE
    ===========================================*/

    public function SubscriptionView(){
        $subscriptions = Subscription::orderBy('id','ASC')->get();
        return view('backend.subscribe.subscribe_view',compact('subscriptions'));
    } //End Method

    //
    /*===========================================
    ADD Subscription
    ===========================================*/

    public function SubscriptionStore(Request $request){
        $request->validate([
        'offer_title'=>'required',
        'desc_fr'=>'required',
        'advantage'=>'required',
        'listing'=>'required',
        ],[
            'offer_title'=>'saisir le titre de l abonnement',
            'desc_fr'=>'saisir une petite description',
            'advantage'=>'saisir les avantages',
            'listing'=>'saisir le nombre de publication',
        ]);

            $validity=$request->validity+1;

            Subscription::insert([
                'offer_title'=>$request->offer_title,
                'desc_fr'=>$request->desc_fr,
                'price'=>$request->price,
                'listing'=>$request->listing,
                'validity'=>$validity,
                'advantage'=>$request->advantage,
                'disadvantage'=>$request->disadvantage,
                'percent'=>$request->percent,
            ]);

            $notification = array(
                'message' =>'Abonnement Inserer avec Succes',
                'alert-type'=>'success'
            );

        return redirect()->back()->with($notification);
        
    } //End Method

    /*===========================================
    EDIT Abonnement
    ===========================================*/

    public function SubscriptionEdit($id){
        $subscription = Subscription::findOrFail($id);
        return view('backend.subscribe.subscribe_edit',compact('subscription'));
    } //End Method

    public function SubscriptionUpdate(Request $request){
        $sub_id = $request->id;
        
           Subscription::findOrFail($sub_id)->update([
            'offer_title'=>$request->offer_title,
            'desc_fr'=>$request->desc_fr,
            'price'=>$request->price,
            'listing'=>$request->listing,
            'validity'=>$request->validity,
            'advantage'=>$request->advantage,
            'disadvantage'=>$request->disadvantage,
            'percent'=>$request->percent,
            ]);



        $notification = array(
            'message' =>'Mise à jour effectuer',
            'alert-type'=>'info'
        );

        return redirect()->back()->with($notification);

    } //End Method
}
