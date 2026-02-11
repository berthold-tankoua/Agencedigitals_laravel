<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Utility\Utility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function AddToWishlist($product_id){

        if(Auth::check()){
           
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if(!$exists){
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now()
                ]);
                return response()->json(['success'=> 'Le produit a ete ajouter dans la liste']);
           }else{
            return response()->json(['error'=> 'Le produit existe deja dans la liste ']);
           }
        }else{
            return response()->json(['error'=> 'Veuillez vous connecter a votre compte']);
        }

    }


    public function wishlistView(){
        $wishlists = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        return view('frontend.pages.wishlist.wishlist',compact('wishlists'));
    }

    public function GetWishlistProduct(){

        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        return response()->json($wishlist);
    }

    public function GetWishlistcount(){

        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->get();

        if(empty($wishlist)){
            $wish_count = '0';
        }else{
            $wish_count = count($wishlist);
        }
        return response()->json($wish_count);
    }

    public function DeleteWishlistProduct($rowId){

        Wishlist::findOrFail($rowId)->delete();

        $notification = array(
            'message' => 'Produit supprimé des favoris',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
}
