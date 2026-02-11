<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Utility\Utility;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){

        $product  = Product::findOrFail($id);
        $currency = Utility::currency_code();
        $price    = $product->discount_price ?? $product->selling_price;

        // Vérifie si le panier contient déjà des articles
        if (Cart::count() > 0) {
            // Récupère la devise du premier produit du panier
            $cartCurrency = Cart::content()->first()->options->currency;

            // Si la devise est différente → empêcher l'ajout
            if ($cartCurrency !== $currency) {
                return response()->json([
                    'error' => "Votre panier contient déjà des articles en $cartCurrency. Veuillez terminer ou vider votre commande avant d'acheter en $currency."
                ]);
            }
        }

        // Sinon → ajouter normalement
        Cart::add([
            'id'      => $id,
            'name'    => $product->product_name,
            'qty'     => $request->quantity,
            'price'   => Utility::get_price($price),
            'weight'  => 1,
            'options' => [
                'image'    => $product->product_thambnail,
                'color'    => $request->color,
                'size'     => $request->size,
                'currency' => $currency,
            ],
        ]);

        return response()->json(['success' => "L'article a bien été ajouté à votre panier"]);
    }

    public function updateCartCurrency($currency){


        foreach (Cart::content() as $item) {
            // Recalculer le prix avec la nouvelle devise
            $basePrice = Product::find($item->id)->discount_price ?? Product::find($item->id)->selling_price;
            $convertedPrice = Utility::specific_currency_convert($currency,$basePrice);

            // Mettre à jour chaque article du panier
            Cart::update($item->rowId, [
                'price' => $convertedPrice,
                'options' => [
                    'image'    => $item->options->image,
                    'color'    => $item->options->color,
                    'size'     => $item->options->size,
                    'currency' => $currency,
                ],
            ]);
        }

        return response()->json([
            'success' => "Votre panier a été mis à jour avec la devise $currency"
        ]);
    }


    public function MiniCart(){

      $carts = Cart::content();
      $cartQty = Cart::count();
      $cartTotal = Cart::total();
      return response()->json(array(
        'carts' => $carts,
        'cartQty' => $cartQty,
        'cartTotal' => $cartTotal,
      ));

    }

    public function GetCartProduct(){

      $carts = Cart::content();
      $cartQty = Cart::count();
      $cartTotal = Cart::total();
      return response()->json(array(
        'carts' => $carts,
        'cartQty' => $cartQty,
        'cartTotal' => $cartTotal,
      ));

    }

    public function RemoveMiniCart($rowId){
       Cart::remove($rowId);
       return response()->json(['success' => 'Produit supprimé du panier d achat']);
    }

    public function RemoveCart($rowId){
       Cart::remove($rowId);

        $notification = array(
            'message' => 'Produit supprimé du panier d achat',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function cartView(){
        $carts = Cart::content();
        return view('frontend.pages.wishlist.cart',compact('carts'));
    }

}
