<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use App\Models\WhyChooseUs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Image;

class BrandController extends Controller
{

    public function AboutView()
    {
        $abouts = About::latest()->get();
        return view('backend.about.about_view', compact('abouts'));
    } //End Method

    /*===========================================
    ADD ABOUT
    ===========================================*/

    public function AboutStore(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'country' => 'required',
            'email' => 'required',
            'desc1' => 'required',

        ], [
            'phone' => 'saisir le numero telephone',
            'country' => 'saisir Votre pays et ville',
            'email' => 'saisir l email de l entreprise',
            'desc1' => 'saisir la description de l entreprise',
        ]);

        $about_img = $request->file('about_img');
        $name_gen = hexdec(uniqid()) . '.' . $about_img->getClientOriginalExtension();
        Image::make($about_img)->save('upload/abouts/' . $name_gen);
        $save_url = 'upload/abouts/' . $name_gen;

        About::insert([
            'country' => $request->country,
            'phone' => $request->phone,
            'email' => $request->email,
            'desc1' => $request->desc1,
            'desc2' => $request->desc2,
            'desc3' => $request->desc3,
            'desc4' => $request->desc4,
            'desc5' => $request->desc5,
            'facebook_link' => $request->flink,
            'instagram_link' => $request->ilink,
            'twitter_link' => $request->tlink,
            'about_img' => $save_url,
        ]);

        $notification = array(
            'message' => 'A propos inserer avec succes',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method

    /*===========================================
    EDIT ABOUT
    ===========================================*/

    public function AboutEdit($id)
    {
        Cache::forget('about_info');
        $about = About::findOrFail($id);
        return view('backend.about.about_edit', compact('about'));
    } //End Method

    public function AboutUpdate(Request $request)
    {

        $about = About::findOrFail($request->id);

        // Prépare les données communes
        $data = [
            'localisation'   => $request->localisation,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'desc1'     => $request->about_desc,
            'desc2'    => $request->vision_desc,
            'desc3'    => $request->mission_desc,
            'desc4'    => $request->term_condition,
            'desc5'    => $request->legal_mention,
            'facebook_link'  => $request->flink,
            'instagram_link' => $request->ilink,
            'twitter_link'   => $request->tlink,
        ];

        // Gestion de l'image si uploadée
        if ($request->hasFile('about_img')) {
            $about_img = $request->file('about_img');
            $name_gen = hexdec(uniqid()) . '.' . $about_img->getClientOriginalExtension();
            $path = 'upload/abouts/' . $name_gen;

            Image::make($about_img)->fit(750, 650)->save($path);

            // Supprime l'ancienne image si elle existe
            if ($request->old_img && file_exists($request->old_img)) {
                @unlink($request->old_img);
            }

            $data['about_img'] = $path;
        }

        // Mise à jour
        $about->update($data);
        Cache::forget('about_info'); // vide le cache

        $notification = array(
            'message' => 'Mise à jour effectuer avec succes',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } //End Method


    public function ChooseUsView()
    {
        $item = WhyChooseUs::first();
        return view('backend.chooseus.chooseus_view', compact('item'));
    } //End Method

    public function ChooseUsEdit($id)
    {
        $item = WhyChooseUs::findOrFail($id);
        return view('backend.chooseus.chooseus_edit', compact('item'));
    } //End Method

    public function ChooseUsUpdate(Request $request)
    {
        $id = $request->id;
        $whyChooseUs = WhyChooseUs::findOrFail($id);

        // Prépare les données communes
        $data = [
            'description' => $request->description,
            'icon'       => $request->icon,
            'desc1'       => $request->desc1,
            'desc2'       => $request->desc2,
            'desc3'       => $request->desc3,
        ];

        // Gestion de l’image si uploadée
        if ($request->hasFile('slider_image')) {
            $sliderImage = $request->file('slider_image');
            $name = hexdec(uniqid()) . '.' . $sliderImage->getClientOriginalExtension();
            $path = 'upload/abouts/' . $name;

            Image::make($sliderImage)->fit(950, 908)->save($path);

            // Supprime l'ancienne image si elle existe
            if ($request->old_img && file_exists($request->old_img)) {
                @unlink($request->old_img);
            }

            $data['slider_image'] = $path;
        }

        // Mise à jour
        $whyChooseUs->update($data);

        $notification = array(
            'message' => 'Mise à jour effectuer avec succes',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } //End Method

}
