<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Date;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //
    public function AppointmentDateView(){
        $dates = Date::orderBy('created_at','asc')->get();
        
        return view('backend.date.date', compact( 'dates'));

    }
     public function AppointmentActive($item_id) {

        Date::findOrFail($item_id)->update([
            'status' => 1, 
        ]);
         $notification = array(
            'message' =>'active avec Succes',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    } //End Method
         public function AppointmentInactive($item_id) {

        Date::findOrFail($item_id)->update([
            'status' => 0, 
        ]);
         $notification = array(
            'message' =>'Desactive avec Succes',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    } //End Method

    public function ApointmentAjax($date){
        $bookedTimes = Booking::where('date', $date)
            ->pluck('time')
            ->toArray();

        // Récupère tous les `Date` dont le `time` n'est pas déjà pris
        $availableTimes = Date::whereNotIn('time', $bookedTimes)
            ->orderBy('time', 'asc')->where('status',1)
            ->get();

        return response()->json($availableTimes);
    }
}
