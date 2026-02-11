<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use  App\Models\Slider;
use  App\Models\Category;
use  App\Models\BeautySlider;
use App\Models\SliderNotif;
use Carbon\Carbon;
use Image;


class SliderController extends Controller
{
    /*===========================================
    SLIDER PRINCIPAL VIEW PAGE
    ===========================================*/

    public function ctrSliderPrincipalView() {

        $sliders = Slider::latest()->get();
        $categories = Category::orderBy('category_name_fr','ASC')->get();
        return view('backend.slider.principal.slider_principal_view', compact('sliders','categories'));

    } //End Method


    /*===========================================
    STORE SLIDER PRINCIPAL
    ===========================================*/

    public function ctrSliderStore(Request $request) {

        $request->validate([
            'slider_title'=>'required',
            'slider_desc'=>'required',
            'slider_image_1'=>'required',
           ],[
            'slider_title.required'=>'SVP veuillez insérer le titre  en francais',
            'slider_desc.required'=>'SVP veuillez insérer le description en francais',
            'slider_image_1.required'=>'Une Image est requise pour cette glissière(Slider)',
        ]);

        $store_slider = new Slider();
        $store_slider->slider_small = $request->slider_small;
        $store_slider->slider_title = $request->slider_title;
        $store_slider->slider_desc = $request->slider_desc;
       $store_slider->slider_link = $request->slider_link;

        if($request->file('slider_image_1')){
            $image = $request->file('slider_image_1');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->fit(1920,900)->save('upload/sliders/'.$name_gen);
            $save_url = 'upload/sliders/'.$name_gen;
            $store_slider['slider_image_1'] = $save_url;
        }


        $store_slider->save();

        $notification = array(
            'message' =>'Enregistre avec Succes',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);

    } //End Method


    /*===========================================
    EDIT SLIDER PRINCIPAL
    ===========================================*/

    public function ctrSliderEdit($slider_id) {

        $slider = Slider::findOrFail($slider_id);

        return view('backend.slider.principal.slider_principal_edit', compact('slider'));

    } //End Method


    /*===========================================
    UPDATE SLIDER PRINCIPAL
    ===========================================*/

    public function ctrSliderUpdate(Request $request) {

        $slider_id = $request->id;
        $old_img_1 = $request->old_img_1;
        $old_img_2 = $request->old_img_2;

        $update_slider = Slider::findOrFail($slider_id);
        $update_slider->slider_title = $request->slider_title;
        $update_slider->slider_small1 = $request->slider_small1;
        $update_slider->slider_small2 = $request->slider_small2;
        $update_slider->font_size = $request->font_size;
        $update_slider->slider_desc = $request->slider_desc;

        $update_slider->updated_at = Carbon::now();

        if($request->file('slider_image_1')){

            @unlink($old_img_1);

            $image = $request->file('slider_image_1');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->fit(1920,900)->save('upload/sliders/'.$name_gen);
            $save_url = 'upload/sliders/'.$name_gen;
            $update_slider['slider_image_1'] = $save_url;

        }
        if($request->file('slider_image_2')){

            @unlink($old_img_2);

            $image = $request->file('slider_image_2');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->fit(1920,900)->save('upload/sliders/'.$name_gen);
            $save_url = 'upload/sliders/'.$name_gen;
            $update_slider['slider_image_2'] = $save_url;

        }

        $update_slider->save();

        $notification = array(
            'message' =>'Slider mis à jour avec succès',
            'alert-type'=>'info'
        );

        return redirect()->route('principal.slider.view')->with($notification);

    } //End Method

    /*===========================================
    DELETE SLIDER PRINCIPAL
    ===========================================*/

    public function ctrSliderDelete($slider_id) {

        $slider = Slider::findOrFail($slider_id);
        $slider_image = $slider->slider_image;

        @unlink($slider_image);

        $slider->delete();

        $notification = array(
            'message' =>'Slider supprimé avec succès',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);

    } //End Method

    /*===========================================
    ACTIVE SLIDER PRINCIPAL
    ===========================================*/

    public function SliderActive($slider_id) {

        $active_slider = Slider::findOrFail($slider_id);

        Slider::findOrFail($slider_id)->update(['status' => 1]);

        $notification = array(
            'message' =>'Slider activé avec succès',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);


    } //End Method


    /*===========================================
    INACTIVE SLIDER PRINCIPAL
    ===========================================*/

    public function SliderInactive($slider_id) {

        $inactive_slider = Slider::findOrFail($slider_id);

        Slider::findOrFail($slider_id)->update(['status' => 0]);

        $notification = array(
            'message' =>'Slider désactivé avec succès',
            'alert-type'=>'error'
        );

        return redirect()->back()->with($notification);

    } //End Method

    /*===========================================
     NOTIFICATION SLIDER VIEW PAGE
    ===========================================*/

    public function ctrSliderNotifView() {

        $sliders = SliderNotif::latest()->get();

        return view('backend.slider.notif.slider_notif_view', compact('sliders'));

    } //End Method


    /*===========================================
    STORE SLIDER NOTIF
    ===========================================*/

    public function ctrSliderNotifStore(Request $request) {

        $request->validate([
            'slider_url'=>'required',
            'slider_desc_fr'=>'required',
            'slider_title_fr'=>'required',
            'slider_action_title_fr'=>'required',
            'slider_image'=>'required',
           ],[

            'slider_url.required'=>'SVP veuillez insérer le titre principal en francais',
            'slider_title_fr.required'=>'SVP veuillez insérer le titre  en francais',
            'slider_desc_fr.required'=>'SVP veuillez insérer le description en francais',
            'slider_action_title_fr.required'=>"SVP veuillez insérer le titre de l'action en francais",
            'slider_image.required'=>'Une Image est requise pour cette glissière(Slider)',
        ]);

        $store_slider = new SliderNotif();
        $store_slider->slider_url = $request->slider_url;
        $store_slider->slider_main_title_fr = $request->slider_title_fr;
        $store_slider->slider_action_title_fr = $request->slider_action_title_fr;
        $store_slider->slider_desc_fr = $request->slider_desc_fr;


        if($request->file('slider_image')){

            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->fit(1370,700)->save('upload/sliders/'.$name_gen);
            $save_url = 'upload/sliders/'.$name_gen;
            $store_slider['slider_image'] = $save_url;

        }

        $store_slider->save();

        $notification = array(
            'message' =>'Slider Inserted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);

    } //End Method


    /*===========================================
    EDIT SLIDER NOTIF
    ===========================================*/

    public function ctrSliderNotifEdit($slider_id) {

        $slider = SliderNotif::findOrFail($slider_id);

        return view('backend.slider.notif.slider_notif_edit', compact('slider'));

    } //End Method


    /*===========================================
    UPDATE SLIDER NOTIF
    ===========================================*/

    public function ctrSliderNotifUpdate(Request $request) {

        $slider_id = $request->id;
        $old_img = $request->old_img;

        $update_slider = SliderNotif::findOrFail($slider_id);
        $update_slider->slider_url = $request->slider_url;
        $update_slider->slider_main_title_fr = $request->slider_title_fr;
        $update_slider->slider_action_title_fr = $request->slider_action_title_fr;
        $update_slider->slider_desc_fr = $request->slider_desc_fr;

        $update_slider->updated_at = Carbon::now();

        if($request->file('slider_image')){

            @unlink($old_img);

            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->fit(1370,700)->save('upload/sliders/'.$name_gen);
            $save_url = 'upload/sliders/'.$name_gen;
            $update_slider['slider_image'] = $save_url;

        }

        $update_slider->save();

        $notification = array(
            'message' =>'Slider mis à jour avec succès',
            'alert-type'=>'info'
        );

        return redirect()->route('notif.slider.view')->with($notification);

    } //End Method

    /*===========================================
    DELETE SLIDER NOTIF
    ===========================================*/

    public function ctrSliderNotifDelete($slider_id) {

        $slider = SliderNotif::findOrFail($slider_id);
        $slider_image = $slider->slider_image;

        @unlink($slider_image);

        $slider->delete();

        $notification = array(
            'message' =>'Slider supprimé avec succès',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);

    } //End Method

    /*===========================================
    ACTIVE SLIDER NOTIF
    ===========================================*/

    public function ctrSliderNotifActive($slider_id) {

        $active_slider = SliderNotif::findOrFail($slider_id);

        SliderNotif::findOrFail($slider_id)->update(['status' => 1]);

        $notification = array(
            'message' =>'Slider activé avec succès',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);


    } //End Method


    /*===========================================
    INACTIVE SLIDER NOTIF
    ===========================================*/

    public function ctrSliderNotifInactive($slider_id) {

        $inactive_slider = SliderNotif::findOrFail($slider_id);

        SliderNotif::findOrFail($slider_id)->update(['status' => 0]);

        $notification = array(
            'message' =>'Slider désactivé avec succès',
            'alert-type'=>'error'
        );

        return redirect()->back()->with($notification);

    } //End Method

}
