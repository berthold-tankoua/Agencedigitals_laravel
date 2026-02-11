<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ChatMailNotif;
use Illuminate\Support\Carbon;
use App\Models\User;

use Illuminate\Support\Facades\Mail;

use App\Mail\EmailVerifMail;
use App\Mail\PasswordMail;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\SocialNetwork;

use App\Models\AgentDocument;
use App\Models\ChatMessage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\ChatService;
use Image;

use App\Services\RegisterService;
use App\Services\StoreService;

class UserController extends Controller
{
    protected $registerService;
    protected $storeService;
    protected $chatService;

    public function __construct(RegisterService $registerService, StoreService $storeService, ChatService $chatService)
    {
        $this->registerService = $registerService;
        $this->storeService = $storeService;
        $this->chatService = $chatService;
    }

    /*** Upload an image with optional resizing */
    private function uploadImage($file, $path, $fit = [600, 600])
    {
        $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        Image::make($file)->fit($fit[0], $fit[1])->save("$path/$name");
        return "$path/$name";
    }

    function UserRegisterView()
    { // OK
        $value = 'user';
        if ($value == 'user') {
            $val_french = 'utilisateur';
        }

        return view('auth.register_view', compact('value', 'val_french'));
    }

    public function UserLoginView()
    { // OK

        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        session(['url.intended' => url()->previous()]);
        return view('auth.login');
    }
    public function UserLoginDemand()
    { // OK

        $url = url()->previous();
        if (!session()->has('product_url')) {
            session()->put('product_url', $url);
        }

        return redirect()->route('user.login');
    }

    function create(Request $request)
    { // OK

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',

            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:5',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ], [
            'name.required' => 'Saisir votre Nom & Prenom',
            'email.required' => 'Saisir votre Email',

            'phone.required' => 'Saisir votre Contact',
            'password.required' => 'Le mot de passe doit contenir un caractere speciale(@) | Un chiffre | Une lettre majiscule',
        ]);
        $user = $this->registerService->register($request->all());

        $user = User::where('id', $user->id)->first();
        Auth::login($user, true);
        $notification = array(
            'message' => 'Connexion réussie avec succès',
            'alert-type' => 'success'
        );
        if (session()->has('product_url') == true) {
            return redirect()->to(session()->pull('product_url', '/'))->with($notification);
        } else {
            return redirect()->route('user.dashboard')->with($notification);
        }
    }

    function check(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:15'
        ], [
            'email.required' => 'Email requis',
            'password.required' => 'Mot de passe requis',
        ]);

        $verif_status = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();
        $user = User::where('email', $request->email)->first();

        if (!empty($verif_status)) {

            $creds = $request->only('email', 'password');
            if (Auth::guard('web')->attempt($creds, $request->remember_me)) {

                $notification = array(
                    'message' => 'Connexion réussie avec succès',
                    'alert-type' => 'success'
                );

                if (session()->has('product_url') == true) {

                    return redirect()->to(session()->pull('product_url', '/'))->with($notification);
                } else {

                    return redirect()->route('user.dashboard')->with($notification);
                }
            } else {
                return redirect()->route('user.login')->with('fail', 'Erreur survenue de la connexion');
            }
        } else {

            $email_code = substr(str_shuffle("123456789"), 0, 4) . $user->id;
            User::where('email', $request->email)->update([
                'email_code' => $email_code,
            ]);
            $emailInfo = [
                'title' => 'Verification de l email',
                'code' => $email_code,
            ];
            try {
                Mail::to($request->email)->send(new EmailVerifMail($emailInfo));
            } catch (\Exception $e) {
                // Redirection si pas de connexion ou erreur d'envoi
                $notification = array(
                    'message' => 'Impossible d’envoyer l’email. Vérifiez votre connexion.',
                    'alert-type' => 'error'
                );
                return redirect()->route('login')->with($notification);
            }

            return redirect()->route('user.email.code');
        }
    }

    function twofactorlogin(Request $request)
    { // OK
        $email_val = $request->email;
        $user = User::where('email', $email_val)->first();
        if ($user) {

            $code = substr(str_shuffle("123456789"), 0, 5) . $user->id;
            User::where('email', $email_val)->update([
                'email_code' => $code,
            ]);

            $emailInfo = [
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
                return redirect()->route('login')->with($notification);
            }

            $notification = array(
                'message' => 'Vérifier votre boite mail',
                'alert-type' => 'success'
            );

            return redirect()->route('user.email.code')->with($notification);
        } else {
            $notification = array(
                'message' => 'Votre Email est introuvable',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }


    function EmailVerify(Request $request)
    { // OK

        $code_val = $request->email_code;

        $user = User::where('email_code', $code_val)->first();
        if ($user) {
            User::where('email_code', $code_val)->update([
                'email_verified_at' => Carbon::now(),
                'email_code' => null,
            ]);

            Auth::login($user, true);
            if (session()->has('product_url') == true) {
                return redirect()->to(session()->pull('product_url', '/'));
            } else {

                return redirect()->route('user.dashboard');
            }
        } else {
            $notification = array(
                'message' => 'Le Code saisi ne correspond pas',
                'alert-type' => 'error'
            );
            return redirect()->back()->with('fail', 'Le Code saisi ne correspond pas');
        }
    }

    function UserDashboard()
    { // OK

        if (Auth::check()) {
            $orders =  Order::where('user_id', Auth::id())->latest()->get();
            return view('frontend.pages.users.dashboard', compact('orders'));
        }
    }

    function UserOrderDetail($orderId)
    { // OK

        if (Auth::check()) {
            $order =  Order::where('id', $orderId)->where('user_id', Auth::id())->first();
            $orderItems = OrderItem::where('order_id', $order->id)->latest()->get();

            return view('frontend.pages.users.order_details', compact('order', 'orderItems'));
        }
    }

    public function UserPaidRemainOrder($orderId)
    {
        $order =  Order::where('id', $orderId)->where('user_id', Auth::id())->first();
        return view('frontend.pages.checkout.remaining', compact('order'));
    }

    function UserProfil()
    { // OK

        if (Auth::check()) {
            return view('frontend.pages.users.profil');
        }
    }

    function UpdateProfil(Request $request)
    { // OK

        $id = $request->user_id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        $data->save();

        $notification = array(
            'message' => 'Compte mise a jour avec succes',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



    function SendCode(Request $request)
    {

        $email_val = $request->email;
        $user = User::where('email', $email_val)->first();

        if ($user) {
            $reset_code = substr(str_shuffle("123456789"), 0, 5) . $user->id;

            User::where('email', $email_val)->update([
                'email_code' => $reset_code,
            ]);

            $resetInfo = [
                'title' => 'AgenceDigitals Code de verification',
                'code' => $reset_code,
            ];
            Mail::to("$request->email")->send(new PasswordMail($resetInfo));

            $notification = array(
                'message' => 'Code envoye par email avec succes',
                'alert-type' => 'success'
            );

            return redirect()->route('user.check.code')->with($notification);
        } else {
            # code...
            $notification = array(
                'message' => 'Erreur verifier que vous avez bien saisi votre Email',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function ForgetPassword()
    {
        if (Auth::check()) {
            Auth::guard('web')->logout();
        }
        return view('auth.forgot-password');
    }

    function ResetPassword(Request $request)
    { // OK

        $code_val = $request->reset_code;
        $user = User::where('email_code', $code_val)->first();
        if ($user) {
            User::where('email_code', $code_val)->update([
                'password' => Hash::make($request->password),
                'email_code' => null,
            ]);

            $notification = array(
                'message' => 'Mot de passe mis à jour avec succes',
                'alert-type' => 'success'
            );

            Auth::login($user, true);
            if (session()->has('product_url') == true) {
                return redirect()->to(session()->pull('product_url', '/'));
            } else {
                return redirect()->route('user.dashboard')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Le Code saisi ne correspond pas',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    function logout()
    { // OK
        Auth::guard('web')->logout();
        return redirect()->route('user.dashboard');
    }

    public function UserChatMessage()
    {
        if (!Auth::check()) {
            $admin = Admin::findorfail(2);
            $user = User::where('email', $admin->email)->first();
            Auth::login($user, true);
        }
        return view('frontend.pages.users.chat_list');
    }

    public function UserChatDetail($userId)
    {
        $authId = auth()->id();
        ChatMessage::where('sender_id', $userId)->where('receiver_id', $authId)
            ->where('is_read', 0)->update(['is_read' => 1]);
        return view('frontend.pages.users.chat_detail', compact('userId'));
    }

    public function UserChatInit(Request $request)
    {

        $this->chatService->sendMessage($request->all());

        return redirect()->route('user.chat.detail', $request->recevier_id);
    } // End Method



}
