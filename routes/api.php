<?php

use App\Http\Controllers\Api\BotController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\StripeWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\PushSubscription;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('product')->group(function () {
    Route::get('/list', [BotController::class, 'ProductList']);
    Route::get('/image/list', [BotController::class, 'ProductImgList']);
    Route::get('/item/{id}', [BotController::class, 'ProductImageItem']);
    Route::post('/image/update/{id}', [BotController::class, 'CompressImageUpdate']);
});

Route::post("push-subscribe", function(Request $request) {

 PushSubscription::create([
    'user_id' => Auth::id(),
    'data'=> $request->getContent(),
 ]);

});

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
