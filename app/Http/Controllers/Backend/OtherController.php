<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Contact;
use App\Models\StoreMsg;
use App\Models\Blog;
use App\Models\User;
use App\Models\Booking;
use App\Models\Testimonial;
use App\Models\PushSubscription;
use App\Models\Review;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use Image;


class OtherController extends Controller
{
    /*===========================================
    CITY PAGE
    ===========================================*/

    public function CityView(){
        $cities = City::latest()->get();

        return view('backend.city.city_view',compact('cities'));
    } //End Method

    /* STORE CITY CODE */
    public function CityStore(Request $request){
        $request->validate([
         'city_name_fr'=>'required',
         'image'=>'required',
        ],[
         'city_name_fr'=>'Saisir une ville ',
         'image'=>'inseré une image',
        ]);

        if($request->file('image')){

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->fit(600,600)->save('upload/cities/'.$name_gen);
            $save_url = 'upload/cities/'.$name_gen;

            City::insert([
                'city_name_fr'=>$request->city_name_fr,
                'city_slug_fr'=>strtolower(str_replace('','-',$request->city_name_fr)),
                'image'=>$save_url,
            ]);

            $notification = array(
                'message' =>'Ville inseré avec Succes',
                'alert-type'=>'success'
            );

        }else{

            City::insert([
                'city_name_fr'=>$request->city_name_fr,
                'city_slug_fr'=>strtolower(str_replace('','-',$request->city_name_fr)),
            ]);

            $notification = array(
                'message' =>'Ville inseré avec Succes',
                'alert-type'=>'success'
            );

        }

        return redirect()->back()->with($notification);

    } //End Method

    /* EDIT CITY CODE */
    public function CityEdit($id){
        $city = City::findOrFail($id);
        return view('backend.city.city_edit',compact('city'));
    } //End Method

    /* DELETE CITY CODE */
    public function CityUpdate(Request $request){
        $city_id = $request->id;
        $old_img = $request->old_image;

        if($request->file('image')){

            @unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->fit(600,600)->save('upload/cities/'.$name_gen);
            $save_url = 'upload/cities/'.$name_gen;

            City::findOrFail($city_id)->update([
                'city_slug_fr'=> strtolower(str_replace('','-',$request->city_name_fr)),
                'city_name_fr'=> $request->city_name_fr,
                'image'=> $save_url,
            ]);
        }else{

            City::findOrFail($city_id)->update([
                'city_slug_fr'=> strtolower(str_replace('','-',$request->city_name_fr)),
                'city_name_fr'=> $request->city_name_fr,
            ]);

        }

        $notification = array(
            'message' =>'Mise a jour effectue avec succes',
            'alert-type'=>'info'
        );

        return redirect()->route('all.city')->with($notification);

    } //End Method

    /* DELETE CITY CODE */
    public function CityDelete($id){

        $city = City::findOrFail($id);
        $image = $city->image;
        @unlink($image);
        City::findOrFail($id)->delete();

        $notification = array(
            'message' =>'Ville Supprime',
            'alert-type'=>'success'
        );
        return redirect()->route('all.city')->with($notification);

    } //End Method

    /*===========================================
    MESSAGE PAGE
    ===========================================*/

    public function MessageView(){
        $contacts = Contact::latest()->get();
        return view('backend.contact.contact_view',compact('contacts'));
    } //End Method

    public function BookingView(){
        $contacts = Booking::latest()->get();
        return view('backend.contact.booking_view',compact('contacts'));
    } //End Method
    public function BookingDelete($id){
        Booking::findOrFail($id)->delete();
        $notification = array(
            'message' =>'Rendez-vous supprime',
            'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
    } //End Method


    /* DELETE MESSAGE CODE */
    public function MessageDelete($id){
        Contact::findOrFail($id)->delete();
        $notification = array(
            'message' =>'Message supprime',
            'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
    } //End Method

    /*===========================================
    BLOG PAGE
    ===========================================*/

    public function AdminBlogView(){
        $blogs = Blog::latest()->get();
        return view('backend.blog.blog_view',compact('blogs'));
    } //End Method

    /* STORE BLOG CODE */
    public function AdminBlogStore(Request $request){
        $request->validate([
        'author'=>'required',
        'author_note'=>'required',
        'title1'=>'required',
        'blog_img'=>'required',

        ],[
            'author'=>'saisir le nom de l auteur',
            'author_note'=>'saisir une petite note',
            'title1'=>'saisir un titre principal',
            'blog_img'=>'Inseré une image',
        ]);

           $blog_img = $request->file('blog_img');
            $name_gen = hexdec(uniqid()).'.'.$blog_img->getClientOriginalExtension();
            Image::make($blog_img)->fit(1000,800)->save('upload/blogs/'.$name_gen);
            $save_url = 'upload/blogs/'.$name_gen;

            Blog::insert([
                'author'=>$request->author,

                'author_note'=>$request->author_note,
                'title'=>$request->title1,
                'short_desc'=>$request->short_desc,
                'long_desc'=>$request->long_desc,
                'tags'=>$request->tags,
                'blog_img'=>$save_url,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' =>'Aricle inseré avec succes',
                'alert-type'=>'success'
            );

        return redirect()->back()->with($notification);

    } //End Method

    /* EDIT BLOG CODE */
    public function AdminBlogEdit($id){
        $blog = Blog::findOrFail($id);
        return view('backend.blog.blog_edit',compact('blog'));
    } //End Method

    public function AdminBlogUpdate(Request $request){
        $blog_id = $request->id;
        $old_img = $request->old_img;
        $blog_img = $request->file('blog_img');

        if($request->file('blog_img')){
            $name_gen = hexdec(uniqid()).'.'.$blog_img->getClientOriginalExtension();
            Image::make($blog_img)->fit(1000,800)->save('upload/blogs/'.$name_gen);
            $save_url = 'upload/blogs/'.$name_gen;
            @unlink($old_img);
            Blog::findOrFail($blog_id)->update([
                'author'=>$request->author,
                'author_note'=>$request->author_note,
                'title'=>$request->title1,
                'short_desc'=>$request->short_desc,
                'long_desc'=>$request->long_desc,
                'tags'=>$request->tags,
                'blog_img'=>$save_url,
                'created_at' => Carbon::now()
                ]);
        }else{
            Blog::findOrFail($blog_id)->update([
                'author'=>$request->author,
                'author_note'=>$request->author_note,
                'title'=>$request->title1,
                'short_desc'=>$request->short_desc,
                'long_desc'=>$request->long_desc,
                'tags'=>$request->tags,
                'created_at' => Carbon::now()
                ]);
        }

        $notification = array(
            'message' =>'Mise à jour effectuer avec succes',
            'alert-type'=>'info'
        );

        return redirect()->back()->with($notification);

    } //End Method

    /* DELETE BLOG CODE */
    public function AdminBlogDelete($id){
        Blog::findOrFail($id)->delete();
        Review::where('blog_id',$id)->delete();
        $notification = array(
            'message' =>'Article supprrimer avec succes',
            'alert-type'=>'info'
        );

        return redirect()->back()->with($notification);

    } //End Method

    /*===========================================
    NOTIFICATION PAGE
    ===========================================*/

    public function AdminnotifView(){
        $notifs = PushSubscription::latest()->get();
        $pushs = PushSubscription::whereNotNull('user_id')->get();
        return view('backend.notifs.notif_view',compact('notifs','pushs'));
    } //End Method

    /* STORE USER NOTIF REGISTER CODE */
    public function AdminnotifStore(Request $request){
        $request->validate([
        'title'=>'required',
        'body'=>'required',
        ],[
            'title'=>'saisir le titre',
            'body'=>'saisir le texte',
        ]);

        $webPush = new WebPush([
            'VAPID' => [
                'subject' => 'http://127.0.0.1:8000/', // can be a mailto: or your website address
                'publicKey' => 'BLjvdpMnqRjyg1U34Z3aRoPeRZQZ1NgZhYVeRxub-_Gs-1YDC1Q0u90fNBIMdOv0XQdoNmLZ5Ptnmhn6So5LEX8', // (recommended) uncompressed public key P-256 encoded in Base64-URL
                'privateKey' => '8OF0onGIpWQO2-35cINKE-wsvzgisd5KwnF3FVcCPIE', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
            ]
        ]);

        if ($request->user_id) {

            $notif = PushSubscription::where('user_id',$request->user_id)->first();
            $webPush->sendOneNotification(
                Subscription::create(json_decode($notif->data, true)),
                json_encode($request->input())
            );
        } else {

            $notifs = PushSubscription::latest()->get();
            foreach ($notifs as $value) {
                # code...
               $webPush->sendOneNotification(
                    Subscription::create(json_decode($value->data, true)),
                    json_encode($request->input())
                );
            }
        }

        $notification = array(
            'message' =>'Notification envoyee avec succes',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    } //End Method


    public function AdminnotifDelete($id){

        PushSubscription::findOrFail($id)->delete();
        $notification = array(
            'message' =>'Notification supprrimer avec succes',
            'alert-type'=>'info'
        );

        return redirect()->back()->with($notification);

    } //End Method

    /*===========================================
    Testimonial PAGE VIEW PAGE
    ===========================================*/

    public function AdminTestimonialView(){

        $testimonials = Testimonial::latest()->get();
        return view('backend.testimonial.testimonial_view',compact('testimonials'));
    } //End Method


    public function AdminTestimonialStore(Request $request){
        $request->validate([
        'name'=>'required',
        'job'=>'required',

        ],[
            'name'=>'saisir le nom ',
            'job'=>'saisir le metier',
        ]);

           Testimonial::insert([
                'name'=>$request->name,
                'job'=>$request->job,
                'comment'=>$request->comment,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' =>'Avis inseré avec succes',
                'alert-type'=>'success'
            );

        return redirect()->back()->with($notification);

    } //End Method


    public function AdminTestimonialEdit($id){
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonial.testimonial_edit',compact('testimonial'));
    } //End Method

    public function AdminTestimonialUpdate(Request $request){
        $testi_id = $request->id;

            Testimonial::findOrFail($testi_id)->update([
                'name'=>$request->name,
                'job'=>$request->job,
                'comment'=>$request->comment,
                'created_at' => Carbon::now()
             ]);

        $notification = array(
            'message' =>'Mise à jour effectuer avec succes',
            'alert-type'=>'info'
        );

        return redirect()->back()->with($notification);

    } //End Method

    public function UserDelete($id){

        $user= User::findOrFail($id);

        User::findOrFail($id)->delete();

    }
}
