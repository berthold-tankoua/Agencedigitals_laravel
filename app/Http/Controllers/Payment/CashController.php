<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\AdminOrderNotifEmail;
use Illuminate\Http\Request;

use App\Models\Subscription;
use App\Services\CheckoutService;
use Illuminate\Support\Facades\Auth;

use App\Utility\Utility;

class CashController extends Controller {
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService){

        $this->checkoutService = $checkoutService;

    }

    public function CashOrder(Request $request){

    }

}
