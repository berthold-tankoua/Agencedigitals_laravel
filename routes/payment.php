
<?php

use App\Http\Controllers\Payment\CashController;
use App\Http\Controllers\Payment\CheckoutController;
use App\Http\Controllers\Payment\CinetpayController;
use App\Http\Controllers\Payment\NotchpayController;
use App\Http\Controllers\Payment\StripeController;
use Illuminate\Support\Facades\Route;



// **** USER CHECKOUT ROUTES ****

Route::get('/checkout/product', [CheckoutController::class, 'ProductCheckout'])->name('checkout');

// Product checkout store Route
Route::post('/checkout/product/store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');


// **** Notchpay CHECKOUT ROUTES ****

// Notchpay order
Route::post('/notchpay/payment/order',[NotchpayController::class, 'NotchpayAction'])->name('notchpay.view');
Route::any('/notchpay/check', [NotchpayController::class, 'NotchpayCheckOrder'])->name('notchpay.check.order');
Route::get('/notchpay/payment/success', [NotchpayController::class, 'NotchpaySuccess'])->name('notchpay.success');
Route::get('/notchpay/payment/cancel', [NotchpayController::class, 'NotchpayCancel'])->name('notchpay.cancel');

// **** STRIPE CHECKOUT ROUTES ****

// stripe order 1 : Checkout Page
Route::post('/stripe/subscription/order',[StripeController::class, 'StripeCheckoutPage'])->name('stripe.checkout');

// stripe order 2 : Paid Remaining Order
Route::post('/stripe/paid/remaining/order',[StripeController::class, 'StripePaidRemainingOrder'])->name('stripe.paid.remaining.order');

/// Paiement Status All Routes ////
Route::get('/stripe/payment/status', [StripeController::class, 'StripePaymentStatus'])->name('stripe.status');
Route::get('/stripe/payment/cancel', [StripeController::class, 'StripeCancel'])->name('stripe.cancel');


// **** FREE CHECKOUT ROUTES ****
Route::post('/free/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

Route::get('/invoice/view', [CheckoutController::class, 'InvoiceView'])->name('invoice.view');

// **** AJAX INVOICE MAIL ****
Route::get('/send-invoice-mail',[CheckoutController::class, 'SendInvoiceMail'])->name('invoice.mail.send');

