<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use App\Models\Category;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    /*===========================================
    VIEW ALL PROperties VIEW PAGE
    ===========================================*/

    public function ctrViewAllAnnonces() {
        $categories = Category::latest()->get();
        $annonces= Annonce::latest()->get();
        return view('backend.annonce.annonce_view', compact('categories','annonces'));

    } //End Method



    public function ctrStoreAnnonce(Request $request) {

        $request->validate([
            'titre'=>'required',
            'desc'=>'required',
            'category_id'=>'required',
            ],[
            
            'titre'=>'Saisir un titre',
            'category_id'=>'Selectionner la categorie',
            'desc'=>'saisir le texte',
        ]);

       Annonce::insertGetId([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'titre' => $request->titre,
            'desc' => $request->desc,
            'location' => $request->location,
        ]);


        $notification = array(
			'message' => 'Annonce  Inserer avecSucces',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);


    } //End Method


    public function ctrEditAnnonce($id){
        $categories = Category::latest()->get();
		$annonce = Annonce::findOrFail($id);
		return view('backend.annonce.annonce_edit',compact('annonce','categories'));

	}

    public function UpdateAnnonce(Request $request){

        $annonce_id=$request->id;
            Annonce::findOrFail($annonce_id)->update([
                'category_id' => $request->category_id,
                'titre' => $request->titre,
                'desc' => $request->desc,
                'location' => $request->location,
            ]);


        $notification = array(
			'message' => 'Annonce mise-à-jour avec succès',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);


	} // end method 
    public function ctrAnnonceDelete($id){

        Annonce::findOrFail($id)->delete();

        $notification = array(
           'message' => 'Publication supprime avec Succes',
           'alert-type' => 'success'
        );

       return redirect()->back()->with($notification);

    }// end method 



}
