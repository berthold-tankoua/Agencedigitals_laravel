<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Frontend\HomeController;

/*===========================================
Auth Routes
===========================================*/

//User Auth Route
Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
       Route::get('/login',[UserController::class, 'UserLoginView'])->name('login');
       Route::get('/login/demand', [UserController::class, 'UserLoginDemand']);
       Route::view('/register/choice','auth.register')->name('register');
       Route::get('/register', [UserController::class, 'UserRegisterView']);
       Route::post('/create',[UserController::class,'create'])->name('create');
       Route::post('/check',[UserController::class,'check'])->name('check');
       Route::post('/two/factor/',[UserController::class,'twofactorlogin'])->name('two.factor.check');
       Route::post('/update',[UserController::class,'update'])->name('update');
       Route::post('/email-verify',[UserController::class,'EmailVerify'])->name('email.verify');
       Route::post('/resend-code',[UserController::class,'ResendCode'])->name('resend.code');

       Route::view('/resend-code-view','auth.resend-code')->name('view-resend-code');

       Route::get('/forget-password',[UserController::class,'ForgetPassword'])->name('forget-password');
       Route::post('/password-send-code',[UserController::class,'SendCode'])->name('send.code');
       Route::view('/password-check-code','auth.check-code')->name('check.code');
       Route::view('/email-check-code','auth.email-code')->name('email.code');
       Route::post('/password-reset',[UserController::class,'ResetPassword'])->name('reset.password');

    });

    Route::middleware(['auth:web','PreventBackHistory'])->group(function(){

        Route::get('/dashoard',[UserController::class, 'UserDashboard'])->name('dashboard');
        Route::get('/profil',[UserController::class, 'UserProfil'])->name('profil');
        Route::post('/profil',[UserController::class, 'UpdateProfil'])->name('update.profil');
        Route::get('/logout',[UserController::class,'logout'])->name('logout');

        Route::get('/order/{orderId}/detail',[UserController::class, 'UserOrderDetail'])->name('order.detail');
        Route::get('/paid/remain/{orderId}/order',[UserController::class, 'UserPaidRemainOrder'])->name('paid.remain.order');

        Route::post('/chat/init/', [UserController::class, 'UserChatInit'])->name('chat.init');
        Route::get('/chat/messages/view', [UserController::class, 'UserChatMessage'])->name('chat.msg');
        Route::get('/chat/details/{userId}', [UserController::class, 'UserChatDetail'])->name('chat.detail');


    });

});

//Admin Auth Route
Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
       Route::view('/login','auth.admin_login')->name('login');
       Route::view('/register','auth.admin_register')->name('register');
       Route::view('/forget-password','auth.admin-code')->name('forget-password');

       Route::post('/reset/code',[AdminController::class,'sendcode'])->name('reset-code');
       Route::view('/password/reset/view','auth.admin_forgot-password')->name('reset-view');
       Route::post('/password/reset',[AdminController::class,'reset'])->name('reset');
       Route::view('/password/reset/succes','auth.admin_reset-sucess')->name('reset-success');

       Route::post('/create',[AdminController::class,'create'])->name('create');
       Route::post('/check/email',[AdminController::class,'check'])->name('check');
        Route::view('/email/code','auth.admin_email-code')->name('email-code');
        Route::post('/check/code',[AdminController::class,'checkCode'])->name('code-check');
    });

    Route::middleware(['web','auth:admin','PreventBackHistory'])->group(function(){

        Route::view('/dashboard','admin.pages.home.index')->name('dashboard.home');
        Route::view('/user/list','backend.users.index')->name('user.list');
        Route::post('/logout',[AdminController::class,'logout'])->name('logout');
        Route::get('/profile',[AdminController::class,'profile'])->name('profile');
        Route::get('/profile/edit',[AdminController::class,'editprofile'])->name('profile_edit');
        Route::post('/profile/store',[AdminController::class,'storeprofile'])->name('profile_store');

    });

});
