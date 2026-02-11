<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Store;
use App\Models\StoreMsg;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function StoreBlogComment(Request $request){

        if(!empty($request->rname) && !empty($request->remail) && !empty($request->rcomment)){
            Review::insert([
                'blog_id' => $request->id,
                'name' => $request->rname,
                'email' => $request->remail,
                'mark' => $request->rmark,
                'status' => 1,
                'comment' => $request->rcomment,
                'created_at' => Carbon::now()
            ]);
            return response()->json(['success'=> 'Votre commentaire à bien été enregistré ']);

        }else{
            return response()->json(['error'=> 'Veuillez remplir tous les champs ']);
        }

   }
   public function StoreProductComment(Request $request){

    if($request->rname && $request->remail && $request->rcomment){
        Review::insert([
            'product_id' => $request->id,
            'name' => $request->rname,
            'email' => $request->remail,
            'mark' => $request->rmark,
            'status' => 1,
            'comment' => $request->rcomment,
            'created_at' => Carbon::now()
        ]);


        return response()->json(['success'=> 'Votre commentaire à bien été enregistré ']);

    }else{
        return response()->json(['error'=> 'Veuillez remplir tous les champs ']);
    }

}


}
