<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Service;
use Carbon\Carbon;
use Image;

class ServiceController extends Controller
{
    /*===========================================
    ADD SERVICE VIEW PAGE
    ===========================================*/

    public function ctrAddServiceView()
    {

        return view('backend.service.service_add');
    } //End Method

    /*===========================================
    VIEW ALL SERVICES VIEW PAGE
    ===========================================*/

    public function ctrViewAllServices()
    {

        $services = Service::all();

        return view('backend.service.view_all_services', compact('services'));
    } //End Method

    /*===========================================
    STORE SERVICES TO THE DATABASE
    ===========================================*/

    public function ctrStoreService(Request $request)
    {

        Service::insertGetId([
            'service_name_fr' => $request->service_name_fr,
            'service_slug_fr' => Str::slug($request->service_name_fr),
            'short_descp_fr' => $request->short_descp_fr,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Service Inserer avec Succes',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method


    /*===========================================
    EDIT SERVICE VIEW PAGE
    ===========================================*/
    public function ctrEditService($id)
    {

        $service = Service::findOrFail($id);
        return view('backend.service.service_edit', compact('service'));
    }

    /*===========================================
    UPDATE SERVICE VIEW PAGE
    ===========================================*/
    public function ctrUpdateService(Request $request)
    {

        $service_id = $request->id;


        Service::findOrFail($service_id)->update([
            'service_name_fr' => $request->service_name_fr,
            'service_slug_fr' => Str::slug($request->service_name_fr),
            'short_descp_fr' => $request->short_descp_fr,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Service mis a jour avec succes',
            'alert-type' => 'info'
        );

        return redirect()->route('view.all.services')->with($notification);
    }

    /*===========================================
    DELETE SERVICES FROM DATABASE
    ===========================================*/

    public function ctrServiceDelete($service_id)
    {
        $service = Service::findOrFail($service_id);
        unlink($service->service_thambnail);
        Service::findOrFail($service_id)->delete();

        $notification = array(
            'message' => 'Service supprime',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method
    /*===========================================
    ACTIVE Service  PRINCIPAL
    ===========================================*/

    public function ctrServiceActive($item_id)
    {

        Service::findOrFail($item_id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Service Active Succes',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method


    /*===========================================
    INACTIVE Service  PRINCIPAL
    ===========================================*/

    public function ctrServiceInactive($item_id)
    {

        Service::findOrFail($item_id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Service Inactive avec Succes',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    } //End Method
}
