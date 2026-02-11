<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
use Carbon\Carbon;

class CurrencyController extends Controller
{
    public function CurrencyLoad(Request $request){
        session()->put('currency_code',$request->code);
        $currency = Currency::where('code',$request->code)->first();
        session()->put('currency_exchange',$currency->exchange_rate);
        session()->put('currency_symbol',$currency->symbol);
        $response['status']=true;
        return $response;
    }
     /*===========================================
    CurrencY PAGE VIEW PAGE
    ===========================================*/

    public function ctrCurrencyView(){
        $currencies = Currency::latest()->get();
        return view('backend.currency.currency_view',compact('currencies'));
    } //End Method

    /*===========================================
    ADD CurrencY
    ===========================================*/

    public function ctrCurrencyStore(Request $request){

        $price = round(floatval($request->exchange_rate));
            Currency::insert([
                'name' => $request->name,
                'code' => $request->code,
                'symbol' => $request->symbol,
                'exchange_rate' => $price,
                'status' => 'active',
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' =>'Currencie insérer avec succès',
                'alert-type'=>'success'
            );
        

        return redirect()->back()->with($notification);

    } //End Method

    /*===========================================
    EDIT CurrencY
    ===========================================*/

    public function ctrCurrencyEdit($id){
        $currency = Currency::findOrFail($id);
        return view('backend.currency.currency_edit',compact('currency'));
    } //End Method

    /*===========================================
    UPDAPTE CurrencY
    ===========================================*/

    public function ctrCurrencyUpdate(Request $request){

        $currency_id = $request->id;
        $price = round(floatval($request->exchange_rate));
        Currency::where('id',$currency_id)->update([
            'name' => $request->name,
            'code' => $request->code,
            'symbol' => $request->symbol,
            'exchange_rate' => $price,
            'status' => $request->status,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Currencie Mise a jour Succes',
            'alert-type' => 'info'
        );

        return redirect()->route('currency.view')->with($notification);

    } //End Method

    /*===========================================
    DELETE CurrencY
    ===========================================*/

    public function ctrCurrencyDelete($id){
        $delete_currency = Currency::findOrFail($id);
        $cat_img = $delete_currency->currency_image;
        @unlink($cat_img);
        $delete_currency->delete();

        $notification = array(
            'message' =>'Currencie supprime avec Succes',
            'alert-type'=>'error'
        );

        return redirect()->route('all.currency')->with($notification);
    } //End Method

    public static function currencyConverter($amount){
        return 1;
    }
}
