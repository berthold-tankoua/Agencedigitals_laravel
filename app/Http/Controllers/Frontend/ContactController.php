<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\NotificationMail;
use Illuminate\Http\Request;
use App\Models\Contact;

use Illuminate\Support\Facades\Mail;

use App\Mail\ClientMail;

use Carbon\Carbon;
use Mockery\Matcher\Not;

class ContactController extends Controller
{

    /*===========================================
    CONTACT PAGE VIEW PAGE
    ===========================================*/

    public function ctrContactUsView()
    {

        return view('frontend.pages.contact.contact_us');
    } //End Method

    /*===========================================
    CONTACT SEND MESSAGE
    ===========================================*/

    public function ctrStoreContactMessage(Request $request)
    {

        if (empty($request->name) && empty($request->email) && empty($request->phone) && empty($request->subject) && empty($request->message)) {
            return response()->json(['error' => 'Veuillez remplir tous les champs']);
        } else {

            $item = Contact::create([

                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'subject'    => $request->subject,
                'message'    => $request->message,
                'created_at' => now(),
            ]);

            dispatch(new NotificationMail($item));

            return redirect()->back()->with('success', 'Votre message a été envoyé avec succès. Nous vous contacterons bientôt.');
        }
    } //End Method

}
