<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Store;
use App\Models\Property;
use App\Models\Subscription;
use App\Cinetpay\Cinetpay;
use App\Mail\DeliveryNotif;
use App\Models\Delivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    //  Orders
	public function OrdersList(){

		$orders = Order::orderBy('id','DESC')->get();
		return view('backend.orders.all_orders',compact('orders'));

	} // end mehtod

    // Order Details
	public function OrdersDetails($order_id){

		$order = Order::where('id',$order_id)->first();
    	$orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
    	return view('backend.orders.orders_details',compact('order','orderItem'));

	} // end method

    public function paidOrders(){

		$orders = Order::where('status','paid')->orwhere('status','partial_paid')->orderBy('id','DESC')->get();
		return view('backend.orders.paid_orders',compact('orders'));

	} // end mehtod

    public function deliveredOrders(){

		$orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
		return view('backend.orders.delivered_orders',compact('orders'));

	} // end mehtod

    public function PaidToship($order_id){
        $order = $order_id;
         $delivers = Delivery::withCount(['orders'])->latest()->get();
		return view('backend.orders.delivery_list',compact('order','delivers'));

    } // end method

    public function AssignDelivery(Request $request){

        $deliver = Delivery::findOrFail($request->delivery_id);
        $deliveryMan=[
            'name' => $deliver->name,
            'order' => $request->orderId,
        ];
        try {
            Mail::to($deliver->email)->send(new DeliveryNotif($deliveryMan));
        } catch (\Exception $e) {
            $notification = array(
             'message' =>'Impossible d’envoyer l’email. Vérifiez votre connexion.',
             'alert-type'=>'error'
            );

           return redirect()->back()->with($notification);
        }

        Order::findOrFail($request->orderId)->update([
            'delivery_id' => $request->delivery_id,
            'status' => 'assigned',
            'picked_date' => Carbon::now()->format('d F Y'),
        ]);

        $notification = array(
              'message' => 'Livreur assigne avec succes',
              'alert-type' => 'success'
          );

        return redirect()->route('all.order')->with($notification);

    } // end method

    public function shipTosuccess($order_id){

        Order::findOrFail($order_id)->update([
            'status' => 'delivered',
            'delivered_date' => Carbon::now()->format('d F Y'),
        ]);


        $notification = array(
              'message' => 'commande termine avec succes',
              'alert-type' => 'success'
          );

        return redirect()->route('all.order')->with($notification);

    } // end method

    public function OrdersProductList(){

		$orderProducts = \App\Models\OrderItem::whereHas('order', function ($q) {
        $q->whereIn('status', ['paid', 'partial_paid']);
        })
        ->select('product_id', DB::raw('SUM(qty) as total_qty'))
        ->groupBy('product_id')
        ->with('product:id,product_name,product_thambnail,category_id')
        ->get();
		return view('backend.orders.product_orders',compact('orderProducts'));

	} // end mehtod

    public function showProductOrders($productId)
    {
        // On récupère uniquement les commandes qui contiennent ce produit ET dont le statut est payé ou partiellement payé
        $orders = OrderItem::with([
                'order' => function ($q) {
                    $q->select('id', 'name', 'email', 'status', 'confirmed_date');
                },
                'product:id,product_name'
            ])
            ->whereHas('order', function ($q) {
                $q->whereIn('status', ['paid', 'partial_paid']);
            })
            ->where('product_id', $productId)
            ->get();

        // Optionnel : grouper par commande
        $grouped = $orders->groupBy('order_id');

        return view('backend.orders.by_product', compact('orders', 'grouped'));
    }

    public function ProductOrderUpdate($productId){
        OrderItem::where('product_id',$productId)->update([
            'status' => 1,
        ]);
        $notification = array(
              'message' => 'Le produit a ete marque comme vu dans toutes les commandes',
              'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
