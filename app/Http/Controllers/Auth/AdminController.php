<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Mail\EmailVerifMail;
use App\Mail\PasswordMail;
use App\Models\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{

    function create(Request $request){ // OK
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:5|max:15'
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['created_at'] = Carbon::now();
        DB::table('admins')->insert($data);

        return redirect()->route('admin.login')->with('success','admin insere Succes');

    }

    function check(Request $request){ // OK
        $email_val = $request->email;
        $admin = Admin::where('email',$email_val)->first();
        if ($admin) {

            $code = substr(str_shuffle("123456789"), 0, 5).$admin->id;
            Admin::where('email',$email_val)->update([
                'code' => $code,
            ]);

            $emailInfo=[
                'title' => 'Vérification de votre email',
                'code' => $code,
            ];

            try {
                Mail::to($request->email)->send(new EmailVerifMail($emailInfo));
            } catch (\Exception $e) {
                // Redirection si pas de connexion ou erreur d'envoi
                 $notification = array(
                'message' => 'Impossible d’envoyer l’email. Vérifiez votre connexion.',
                'alert-type' => 'error'
                );
                return redirect()->route('admin.login')->with($notification);
            }

            $notification = array(
                'message' => 'Vérifier votre boite mail',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.email-code')->with($notification);
        } else {
        $notification = array(
            'message' => 'Votre Email est introuvable',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
        }
    }

    function checkCode(Request $request){ // OK

        $code = $request->code;
        $admin = Admin::where('code',$code)->first();
        Admin::where('code',$code)->update([
            'code' => null,
        ]);

        Auth::guard('admin')->login($admin, true);

        if(Auth::guard('admin')->check()){
            return redirect()->intended('/admin/dashboard');
        }else{
            return redirect()->route('admin.login')->with('fail','Mot de passe ou email incorrect');
        }

    }

    function profile(){ // OK

        $admindata = Admin::find(Auth::id());


        return view('admin.pages.profile.admin_profile', compact('admindata'));
    }

    function editprofile(){ // OK
        $admin_auth_id = Auth::id();
        $editdata = Admin::find($admin_auth_id);
        return view('admin.pages.profile.admin_profile_edit', compact('editdata'));
    }

    function storeprofile(Request $request){ // OK

        $admin_id = $request->id;
        if($request->password){
            $data = Admin::find($admin_id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->save();
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        }else{
            $data = Admin::find($admin_id);
            $data->name = $request->name;
            $data->email = $request->email;
            $notification = array(
              'success' => 'admin profile updated successfully',
             );
            $data->save();

            return redirect()->route('admin.profile')->with($notification);
        }

    }

    function sendcode(Request $request){ // OK
        $email_val = $request->email;
        $admin = Admin::where('email',$email_val)->first();
        if ($admin) {

            $code = substr(str_shuffle("123456789"), 0, 5).$admin->id;

            Admin::where('email',$email_val)->update([
                'code' => $code,
            ]);

            $emailInfo=[
                'title' => 'Modification du mot de passe',
                'code' => $code,
            ];
            Mail::to("$request->email")->send(new PasswordMail($emailInfo));

            $notification = array(
                'message' => 'Verifier votre boite mail',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.reset-view')->with($notification);
        } else {
        $notification = array(
            'message' => 'Votre Email est introuvable',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
        }

    }

    function reset(Request $request){ // OK

        $code = $request->code;
        $admin = Admin::where('code',$code)->first();
        Admin::where('code',$code)->update([
            'password' => Hash::make($request->password),
            'code' => null,
        ]);
        // Connexion avec attempt (identifiant + password)
            $creds = [
                'email' => $admin->email, // ou username ou phone selon ton système
                'password' => $request->password,
            ];

        $notification = array(
            'message' => 'Mot de passe modifié avec succes',
            'alert-type' => 'success'
        );

        $remember_me = true;
        if(Auth::guard('admin')->attempt($creds, $remember_me)){
            Cache::forget('about_info');

            return redirect()->intended('/admin/dashboard');
        }else{
            return redirect()->route('admin.login')->with('fail','Mot de passe ou email incorrect');
        }

    }

    function logout(){ // OK
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }


}
