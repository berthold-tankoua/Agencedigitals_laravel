<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Advertise;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\User;
use App\Models\Store;
use App\Models\MultiImg;
use App\Mail\DeleteMail;
use App\Mail\ExpiryMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\PropertyInactiveMail;
use App\Models\Specification;
use Carbon\Carbon;
use Image;

class AdvertController extends Controller
{

    /*===========================================
    ADD advert VIEW PAGE
    ===========================================*/

    public function ctrAddAdvertView()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $stores = Store::latest()->get();
        return view('backend.advert.advert_add', compact('categories', 'brands', 'stores'));
    } //End Method

    /*===========================================
    VIEW ALL PROperties VIEW PAGE
    ===========================================*/

    public function ctrViewAllAdverts()
    {

        $adverts = Advertise::all();
        $categories = Category::all();

        return view('backend.advert.advert_view', compact('adverts', 'categories'));
    } //End Method

    /*===========================================
    STORE PROperties TO THE DATABASE
    ===========================================*/

    public function ctrStoreAdvert(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'advert_title' => 'required',
            'profil_pic' => 'required',
            'type' => 'required',
            'time' => 'required',
            'street' => 'required',
            'country' => 'required',
            'city' => 'required',
            'multi_img' => 'required',
            'profil_pic' => 'required',
        ], [
            'user_id' => 'Selectionner un utilisateur',
            'type' => 'Selectionner un domaine',
            'advert_title' => 'Saisir un titre',
            'time' => 'Selectionner la duree de l annonce',
            'profil_pic' => 'Inserer une image',
            'street' => 'Saisir le quartier',
            'country' => 'Saisir le pays',
            'city' => 'Saisir la ville ',
            'multi_img' => 'Inserer plusieurs images',
            'profil_pic' => 'Inserer votre photo de profil',
        ]);

        $image = $request->file('advert_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->fit(1080, 1080)->orientate()->save('upload/adverts/thambnail/' . $name_gen);
        $save_url = 'upload/adverts/thambnail/' . $name_gen;

        $video = $request->file('advert_video');
        if ($request->file('advert_video')) {
            $video_name_gen = hexdec(uniqid()) . '.' . $video->getClientOriginalExtension();
            $destinationpath = 'upload/adverts/videos/';
            $video->move($destinationpath, $video_name_gen);
            $video_save_url = 'upload/adverts/videos/' . $video_name_gen;
        } else {
            $video_save_url = null;
        }

        $profil_pic = $request->file('profil_pic');
        if ($request->file('profil_pic')) {
            $profil_name_gen = hexdec(uniqid()) . '.' . $profil_pic->getClientOriginalExtension();
            Image::make($profil_pic)->fit(600, 600)->orientate()->save('upload/profil/' . $profil_name_gen);
            $profil_save_url = 'upload/profil/' . $profil_name_gen;
        }

        $advert_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8);
        $user = User::findorFail($request->user_id);
        $contact = null;
        if ($request->contact) {
            $contact = $request->contact;
        } else {
            $contact = $user->phone;
        }

        $advert_id = Advertise::insertGetId([
            'user_id' => $request->user_id,
            'name' => $user->name,
            'email' => $user->email,
            'type' => $request->type,
            'contact' => $contact,
            'category_id' => null,
            'profil_pic' => $profil_save_url,
            'advert_title' => $request->advert_title,
            'advert_slug' => Str::slug($request->advert_title),
            'advert_code' => $advert_code,
            'advert_thambnail' => $save_url,
            'advert_video' => $video_save_url,
            'advert_tags' => $request->advert_tags_fr,
            'city' => $request->city,
            'country' => $request->country,
            'street' => $request->street,
            'long_descp' => $request->long_descp_fr,
            'short_descp' => $request->short_descp_fr,
            'status' => $request->status,
            'created_at' => Carbon::now(),
            'expiry_date' => Carbon::now()->addDay($request->time),
        ]);

        ////////// Multiple Image Upload Start ///////////

        $images = $request->file('multi_img');

        if ($request->file('multi_img')) {
            foreach ($images as $img) {

                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->orientate()->save('upload/adverts/multi-image/' . $make_name);
                $uploadPath = 'upload/adverts/multi-image/' . $make_name;

                MultiImg::insert([
                    'advert_id' => $advert_id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $notification = array(
            'message' => 'Annonce  Inserer avecSucces',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method


    /*===========================================
    EDIT advert VIEW PAGE
    ===========================================*/
    public function ctrEditAdvert($id)
    {

        $categories = Category::latest()->get();
        $advert = Advertise::findOrFail($id);
        return view('backend.advert.advert_edit', compact('categories', 'advert'));
    }

    /*===========================================
    UPDATE advert VIEW PAGE
    ===========================================*/
    public function UpdateAdvert(Request $request)
    {

        $advert_id = $request->id;
        $old_img = $request->old_img;
        $old_video = $request->old_video;
        $image = $request->file('advert_thambnail');

        $video = $request->file('advert_video');
        if ($request->file('advert_video')) {
            @unlink($old_video);
            $video_name_gen = hexdec(uniqid()) . '.' . $video->getClientOriginalExtension();
            $destinationpath = 'upload/adverts/videos/';
            $video->move($destinationpath, $video_name_gen);
            $video_save_url = 'upload/adverts/videos/' . $video_name_gen;
        } else {
            $video_save_url = $old_video;
        }

        $profil_pic = $request->file('profil_pic');
        if ($request->file('profil_pic')) {
            $profil_name_gen = hexdec(uniqid()) . '.' . $profil_pic->getClientOriginalExtension();
            Image::make($profil_pic)->fit(600, 600)->orientate()->save('upload/profil/' . $profil_name_gen);
            $profil_save_url = 'upload/profil/' . $profil_name_gen;
        } else {
            $profil_save_url = $request->old_profil;
        }

        if ($image) {
            @unlink($old_img);
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->fit(1080, 1080)->orientate()->save('upload/adverts/thambnail/' . $name_gen);
            $save_url = 'upload/adverts/thambnail/' . $name_gen;
            Advertise::findOrFail($advert_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'type' => $request->type,
                'category_id' => null,
                'profil_pic' => $profil_save_url,
                'advert_title' => $request->advert_title,
                'advert_slug' => Str::slug($request->advert_title),
                'advert_thambnail' => $save_url,
                'advert_video' => $video_save_url,
                'advert_tags' => $request->advert_tags_fr,
                'city' => $request->city,
                'country' => $request->country,
                'street' => $request->street,
                'long_descp' => $request->long_descp_fr,
                'short_descp' => $request->short_descp_fr,
            ]);
        } else {
            Advertise::findOrFail($advert_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'type' => $request->type,
                'category_id' => null,
                'profil_pic' => $profil_save_url,
                'advert_title' => $request->advert_title,
                'advert_slug' => Str::slug($request->advert_title),
                'advert_video' => $video_save_url,
                'advert_tags' => $request->advert_tags_fr,
                'city' => $request->city,
                'country' => $request->country,
                'street' => $request->street,
                'long_descp' => $request->long_descp_fr,
                'short_descp' => $request->short_descp_fr,
            ]);
        }

        $images = $request->file('multi_img');

        if ($request->file('multi_img')) {

            $getimages = MultiImg::where('advert_id', $advert_id)->get();
            foreach ($getimages as $img) {
                unlink($img->photo_name);
            }
            MultiImg::where('advert_id', $advert_id)->delete();
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->orientate()->save('upload/adverts/multi-image/' . $make_name);
                $uploadPath = 'upload/adverts/multi-image/' . $make_name;
                MultiImg::insert([
                    'advert_id' => $advert_id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $notification = array(
            'message' => 'Annonce mise-à-jour avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('view.all.adverts')->with($notification);
    } // end method
    public function ctrAdvertDelete($advert_id)
    {
        $advert = Advertise::findOrFail($advert_id);
        unlink($advert->advert_thambnail);
        Advertise::findOrFail($advert_id)->delete();

        $images = MultiImg::where('advert_id', $advert_id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            MultiImg::where('advert_id', $advert_id)->delete();
        }

        $notification = array(
            'message' => 'Publication supprime avec Succes',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method

    public function StoreExpiryVerif()
    {

        $items = Advertise::all();

        foreach ($items as $item) {
            $created = Carbon::now();
            $expiry = $item->expiry_date;
            $diff = $expiry->diffIndays($created);

            if ($diff == 0) {
                Advertise::findOrFail($item->id)->update(['status' => 0]);
            }
        }
    } //End Method

    /*===========================================
    ACTIVE Advert  PRINCIPAL
    ===========================================*/

    public function ctrAdvertActive($item_id)
    {

        Advertise::findOrFail($item_id)->update(['status' => 1]);

        $notification = array(
            'message' => ' Active Succes',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method


    /*===========================================
    INACTIVE Advert  PRINCIPAL
    ===========================================*/

    public function ctrAdvertInactive($item_id)
    {

        Advertise::findOrFail($item_id)->update(['status' => 0]);

        $notification = array(
            'message' => 'desactive avec Succes',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    } //End Method

    public function AdvertExpiryVerif()
    {
        $items = Advertise::all();

        foreach ($items as $item) {
            $get_user = User::findOrFail($item->user_id);
            $user_name = $get_user->name;
            $user_email = $get_user->email;

            $created = Carbon::now();
            $expiry = $item->expiry_date;
            $diff = $expiry->diffIndays($created);

            if ($diff == 0) {
                Advertise::findOrFail($item->id)->update(['status' => 0]);
            } elseif ($diff == 7) {
                // envoie d'un mail pour prevenir l'utilisateur qu'il doit payer
                $expiryInfo = [
                    'title' => 'AgenceDigitals',
                    'name' => $user_name,
                    'store' => 'Publicite',
                ];
                Mail::to("$user_email")->send(new ExpiryMail($expiryInfo));
            }

            $response['status'] = true;
            return $response;
        }
    }
}
