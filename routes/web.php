<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\PushSubscription;
use Illuminate\Http\Request;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CommentController;


use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Frontend\MailController;


use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CinetpayController;
use App\Http\Controllers\User\PaymooneyController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\NotchpayController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\CommandController;

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\OtherController;
use App\Http\Controllers\Backend\SubscriptionController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CurrencyController;
use App\Http\Controllers\Backend\SubCategoryController;

use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StoreController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\AdvertController;
use App\Http\Controllers\Backend\AnnonceController;
use App\Http\Controllers\Backend\Appointment;
use App\Http\Controllers\Backend\AppointmentController;
use App\Http\Controllers\Backend\AutocompleteController;
use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\DeliveryController;
use App\Http\Controllers\Backend\FormationController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\JobController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\User\HistoryController;

/*===========================================
Frontend Routes
===========================================*/

// HomePage Route OK
Route::get('/', [HomeController::class, 'index'])->name('home.index');


// **** FORMATIONS ROUTES ****

// Formation detail Routes
Route::get('/formation/details/{id}/{slug}', [HomeController::class, 'FormationDetails']);

Route::get('/formation/list', [HomeController::class, 'FormationLists'])->name('formation.list');

// Formation categories Routes
Route::get('/formation/category/{id}/{slug}', [HomeController::class, 'FormationCategories']);

// formation search view page
Route::get('formation/search', [HomeController::class, 'SearchViewResult'])->name('formation.search');


Route::any('/ajax/formation/search', [HomeController::class, 'AjaxFormationSearch']);

/*===========================================
Blog Routes
===========================================*/

// ALL Blog view Routes
Route::get('/blog/articles', [HomeController::class, 'AllBlogView'])->name('blogs.all');


// Blog detail Routes
Route::get('/blog/{id}/details', [HomeController::class, 'BlogDetails'])->name('blog.details');


// **** BASIC VIEW ROUTES OK ****

//About Route
Route::get('/about', function () {
    return view('frontend.pages.about.about');
});

Route::get('/our-vision', function () {
    return view('frontend.pages.about.vision');
});

Route::get('/our-mission', function () {
    return view('frontend.pages.about.mission');
});
Route::get('/advantages', function () {
    return view('frontend.pages.about.advantage');
});

Route::get('/mentions-legales', function () {
    return view('frontend.pages.about.mention');
});

Route::get('/termes-conditions', function () {
    return view('frontend.pages.about.terme');
});

Route::get('/faq', function () {
    return view('frontend.pages.about.faq');
});
// **** SERVICES ROUTES OK ****

// Service detail Routes OK
Route::get('/service/list', [HomeController::class, 'ServiceLists'])->name('service.list');

// Service detail Routes OK
Route::get('/service/details/{id}/{slug}', [HomeController::class, 'ServiceDetails'])->name('service.details');


//Contact Route
Route::prefix('contact')->group(function () {

    Route::get('/', function () {
        return view('frontend.pages.contact.contact');
    });

    Route::post('/add', [ContactController::class, 'ctrStoreContactMessage'])->name('add.contact.store');
});

Route::get('/make/appointment', function () {
    return view('frontend.pages.contact.appointment');
});

Route::post('/appointment/add', [ContactController::class, 'MakeApointment'])->name('add.appointment.store');
Route::get('/appointment/date/ajax/{date}', [AppointmentController::class, 'ApointmentAjax']);

// **** BASIC CRON-JOBS ROUTES ROUTES ****


// **** CURRENCY ROUTES ROUTES ****

Route::post('/currency/load', [CurrencyController::class, 'CurrencyLoad'])->name('currency.load');

Route::get('/currency/change/{code}', [HomeController::class, 'ChangeCurrency'])->name('change.currency');

Route::get('/currency-daily-update', [HomeController::class, 'CurrencyDailyUpdate'])->name('currency.daily.update');


Route::post('/language/load', [LanguageController::class, 'LanguageLoad'])->name('language.load');

Route::post("/push-subscribes", function (Request $request) {

    if (Auth::check()) {
        $user_id = Auth::id();
    } else {
        $user_id = null;
    }

    PushSubscription::create([
        'user_id' => $user_id,
        'data' => $request->getContent(),
    ]);
    $response['status'] = true;
    return $response;
});

/*===========================================
Backend Routes
===========================================*/


//PROTECT DASHBOARD ACCESS

Route::middleware(['auth:admin', 'PreventBackHistory'])->middleware('auth:admin')->group(function () {

    // User Routes
    Route::prefix('user')->group(function () {

        Route::get('/delete/{id}', [OtherController::class, 'UserDelete'])->name('user.delete');
    });

    // Message Routes
    Route::prefix('appointment')->group(function () {
        Route::get('/date/view', [AppointmentController::class, 'AppointmentDateView'])->name('appointment.view');
        Route::post('/date/add/', [AppointmentController::class, 'AppointmentDateAdd'])->name('appointment.date.add');
        Route::get('/active/{item_id}', [AppointmentController::class, 'AppointmentActive'])->name('appointment.active');
        Route::get('/inactive/{item_id}', [AppointmentController::class, 'AppointmentInactive'])->name('appointment.inactive');
    });

    // Message Routes
    Route::prefix('message')->group(function () {
        Route::get('/view', [OtherController::class, 'MessageView'])->name('message.view');
        Route::get('/booking/view', [OtherController::class, 'BookingView'])->name('booking.view');
        Route::get('/booking/delete/{id}', [OtherController::class, 'BookingDelete'])->name('booking.delete');
        Route::get('/advert/view', [OtherController::class, 'AdvertView'])->name('advert.view');
        Route::get('/annonce/view', [OtherController::class, 'AnnonceView'])->name('annonce.view');
        Route::get('/client/view', [OtherController::class, 'ClientMessageView'])->name('client.message.view');
        Route::get('/delete/{id}', [OtherController::class, 'MessageDelete'])->name('message.delete');
    });

    // Notifications Routes
    Route::prefix('notification')->group(function () {
        Route::get('/view', [OtherController::class, 'AdminnotifView'])->name('notif.view');
        Route::post('/store', [OtherController::class, 'AdminnotifStore'])->name('notif.store');
        Route::get('/delete/{id}', [OtherController::class, 'AdminnotifDelete'])->name('notif.delete');
    });

    // Blog Routes
    Route::prefix('blog')->group(function () {
        Route::get('/view', [OtherController::class, 'AdminBlogView'])->name('blog.view');
        Route::post('/store', [OtherController::class, 'AdminBlogStore'])->name('blog.store');
        Route::get('/edit/{id}', [OtherController::class, 'AdminBlogEdit'])->name('blog.edit');
        Route::post('/update', [OtherController::class, 'AdminBlogUpdate'])->name('blog.update');
        Route::get('/delete/{id}', [OtherController::class, 'AdminBlogDelete'])->name('blog.delete');
    });

    // Commentaire Routes
    Route::prefix('testimonial')->group(function () {
        Route::get('/view', [OtherController::class, 'AdminTestimonialView'])->name('testimonial.view');
        Route::post('/store', [OtherController::class, 'AdminTestimonialStore'])->name('testimonial.store');
        Route::get('/edit/{id}', [OtherController::class, 'AdminTestimonialEdit'])->name('testimonial.edit');
        Route::post('/update', [OtherController::class, 'AdminTestimonialUpdate'])->name('testimonial.update');
        Route::get('/delete/{id}', [OtherController::class, 'AdminTestimonialDelete'])->name('testimonial.delete');
    });

    // A propos Routes
    Route::prefix('about')->group(function () {
        Route::get('/view', [BrandController::class, 'AboutView'])->name('all.about');
        Route::post('/store', [BrandController::class, 'AboutStore'])->name('about.store');
        Route::get('/edit/{id}', [BrandController::class, 'AboutEdit'])->name('about.edit');
        Route::post('/update', [BrandController::class, 'AboutUpdate'])->name('about.update');

        Route::get('/choose-us/view', [BrandController::class, 'ChooseUsView'])->name('all.choose.us');
        Route::post('/choose-us/store', [BrandController::class, 'ChooseUsStore'])->name('choose.us.store');
        Route::get('/choose-us/edit/{id}', [BrandController::class, 'ChooseUsEdit'])->name('choose.us.edit');
        Route::post('/choose-us/update', [BrandController::class, 'ChooseUsUpdate'])->name('choose.us.update');
    });



    // Abonnement Routes
    Route::prefix('subscription')->group(function () {
        Route::get('/view', [SubscriptionController::class, 'SubscriptionView'])->name('all.subscription');
        Route::post('/store', [SubscriptionController::class, 'SubscriptionStore'])->name('subscription.store');
        Route::get('/edit/{id}', [SubscriptionController::class, 'SubscriptionEdit'])->name('subscription.edit');
        Route::post('/update', [SubscriptionController::class, 'SubscriptionUpdate'])->name('subscription.update');
    });

    // Categories Routes (Test OK)
    Route::prefix('category')->group(function () {
        Route::get('/view', [CategoryController::class, 'ctrCategoryView'])->name('all.category');
        Route::post('/store', [CategoryController::class, 'ctrCategoryStore'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'ctrCategoryEdit'])->name('category.edit');
        Route::post('/update', [CategoryController::class, 'ctrCategoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'ctrCategoryDelete'])->name('category.delete');

        // SubCategories Routes
        Route::get('/sub/view', [SubCategoryController::class, 'ctrSubCategoryView'])->name('all.subcategory');
        Route::post('/sub/store', [SubCategoryController::class, 'ctrSubCategoryStore'])->name('subcategory.store');
        Route::get('/sub/edit/{id}', [SubCategoryController::class, 'ctrSubCategoryEdit'])->name('subcategory.edit');
        Route::post('/sub/update', [SubCategoryController::class, 'ctrSubCategoryUpdate'])->name('subcategory.update');
        Route::get('/sub/delete/{id}', [SubCategoryController::class, 'ctrSubCategoryDelete'])->name('subcategory.delete');

        // SubSubCategories Routes
        Route::get('/sub/sub/view', [SubCategoryController::class, 'ctrSubSubCategoryView'])->name('all.subsubcategory');
        Route::post('/sub/sub/store', [SubCategoryController::class, 'ctrSubSubCategoryStore'])->name('subsubcategory.store');
        Route::get('/sub/sub/edit/{subsubcat_id}', [SubCategoryController::class, 'ctrSubSubCategoryEdit'])->name('subsubcategory.edit');
        Route::post('/sub/sub/update', [SubCategoryController::class, 'ctrSubSubCategoryUpdate'])->name('subsubcategory.update');
        Route::get('/sub/sub/delete/{subsubcat_id}', [SubCategoryController::class, 'ctrSubSubCategoryDelete'])->name('subsubcategory.delete');

        // Ajax Request
        Route::get('/subcategories/ajax/{category_id}', [SubCategoryController::class, 'ctrGetSubCategoryView']);
        Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'ctrGetSubSubCategory']);
    });
    // Currencies Routes
    Route::prefix('currency')->group(function () {
        Route::get('/view', [CurrencyController::class, 'ctrCurrencyView'])->name('currency.view');
        Route::post('/store', [CurrencyController::class, 'ctrCurrencyStore'])->name('currency.store');
        Route::get('/edit/{id}', [CurrencyController::class, 'ctrCurrencyEdit'])->name('currency.edit');
        Route::post('/update', [CurrencyController::class, 'ctrCurrencyUpdate'])->name('currency.update');
        Route::get('/delete/{id}', [CurrencyController::class, 'ctrCurrencyDelete'])->name('currency.delete');
    });

    // Formations Routes
    Route::prefix('formations')->group(function () {

        // Add Formations
        Route::get('/add', [FormationController::class, 'ctrAddFormationView'])->name('add.formation.view');
        Route::post('/store', [FormationController::class, 'ctrStoreFormation'])->name('formation.store');

        Route::get('/delete/{formation_id}', [FormationController::class, 'ctrFormationDelete'])->name('formation.delete');
        Route::get('/edit/{id}', [FormationController::class, 'ctrEditFormation'])->name('formation.edit');
        Route::post('/update', [FormationController::class, 'ctrUpdateFormation'])->name('formation.update');
        // Active & InActive Formation
        Route::get('/active/{item_id}', [FormationController::class, 'ctrFormationActive'])->name('formation.active');
        Route::get('/inactive/{item_id}', [FormationController::class, 'ctrFormationInactive'])->name('formation.inactive');
    });

    // Services Routes
    Route::prefix('services')->group(function () {
        Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
            // Add Services
            Route::get('/add', [ServiceController::class, 'ctrAddServiceView'])->name('add.service.view');
            Route::post('/store', [ServiceController::class, 'ctrStoreService'])->name('add.service.store');

            // All Services
            Route::get('/all', [ServiceController::class, 'ctrViewAllServices'])->name('view.all.services');
            Route::get('/delete/{service_id}', [ServiceController::class, 'ctrServiceDelete'])->name('service.delete');
            Route::get('/edit/{id}', [ServiceController::class, 'ctrEditService'])->name('service.edit');
            Route::post('/update', [ServiceController::class, 'ctrUpdateService'])->name('service.update');
            // Active & InActive Service
            Route::get('/active/{item_id}', [ServiceController::class, 'ctrServiceActive'])->name('service.active');
            Route::get('/inactive/{item_id}', [ServiceController::class, 'ctrServiceInactive'])->name('service.inactive');
        });
    });


    // Adverts Routes
    Route::prefix('annonce')->group(function () {
        // All Annonces
        Route::get('/view', [AnnonceController::class, 'ctrViewAllAnnonces'])->name('view.all.annonces');
        Route::post('/store', [AnnonceController::class, 'ctrStoreAnnonce'])->name('annonce.store');
        Route::get('/delete/{id}', [AnnonceController::class, 'ctrAnnonceDelete'])->name('annonce.delete');
        Route::get('/edit/{id}', [AnnonceController::class, 'ctrEditAnnonce'])->name('annonce.edit');
        Route::post('/update', [AnnonceController::class, 'UpdateAnnonce'])->name('update.annonce');
        // Active & InActive annonce
        Route::get('/active/{item_id}', [AnnonceController::class, 'ctrAnnonceActive'])->name('annonce.active');
        Route::get('/inactive/{item_id}', [AnnonceController::class, 'ctrAnnonceInactive'])->name('annonce.inactive');
        Route::post('/inactive/message', [AnnonceController::class, 'ctrAnnonceInactiveMsg'])->name('annonce.inactive.msg');
    });

    // Slider Routes
    Route::prefix('slider')->group(function () {

        // Principal Slider
        Route::get('/principal/view', [SliderController::class, 'ctrSliderPrincipalView'])->name('principal.slider.view');
        Route::post('/principal/store', [SliderController::class, 'ctrSliderStore'])->name('slider.store');
        Route::get('/principal/edit/{slider_id}', [SliderController::class, 'ctrSliderEdit'])->name('slider.edit');
        Route::post('/principal/update', [SliderController::class, 'ctrSliderUpdate'])->name('slider.update');
        Route::get('/principal/delete/{slider_id}', [SliderController::class, 'ctrSliderDelete'])->name('slider.delete');

        // Active & InActive Slider
        Route::get('/active/{slider_id}', [SliderController::class, 'SliderActive'])->name('slider.active');
        Route::get('/inactive/{slider_id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');

        // Notification Slider
        Route::get('/notification/view', [SliderController::class, 'ctrSliderNotifView'])->name('notif.slider.view');
        Route::post('/notification/store', [SliderController::class, 'ctrSliderNotifStore'])->name('slider.notif.store');
        Route::get('/notification/edit/{slider_id}', [SliderController::class, 'ctrSliderNotifEdit'])->name('slider.notif.edit');
        Route::post('/notification/update', [SliderController::class, 'ctrSliderNotifUpdate'])->name('slider.notif.update');
        Route::get('/notification/delete/{slider_id}', [SliderController::class, 'ctrSliderNotifDelete'])->name('slider.notif.delete');
        // Active & InActive notif Slider
        Route::get('/notification/active/{item_id}', [SliderController::class, 'ctrSliderNotifActive'])->name('notif.slider.active');
        Route::get('/notification/inactive/{item_id}', [SliderController::class, 'ctrSliderNotifInactive'])->name('notif.slider.inactive');
    });


    // Contact Routes
    Route::prefix('contact')->group(function () {

        Route::get('/view', [ContactController::class, 'ContactView'])->name('all.contact.view');
        Route::get('/delete/{id}', [ContactController::class, 'ContactDelete'])->name('contact.delete');
    });

    // Orders Routes
    Route::prefix('orders')->group(function () {

        //All orders
        Route::get('/list', [OrderController::class, 'OrdersList'])->name('all.order');

        //All product orders count
        Route::get('/product/list', [OrderController::class, 'OrdersProductList'])->name('product.order.list');

        // orders details
        Route::get('/details/{id}', [OrderController::class, 'OrdersDetails'])->name('order.details');

        //Paid orders
        Route::get('/paid', [OrderController::class, 'paidOrders'])->name('paid.order');

        //Succes delivered orders
        Route::get('/success', [OrderController::class, 'deliveredOrders'])->name('delivered.order');

        // Update Status
        Route::get('/paid/ship/{order_id}', [OrderController::class, 'PaidToship'])->name('paid-ship');
        Route::post('/assign/deliver', [OrderController::class, 'AssignDelivery'])->name('assign.deliver');
        Route::get('/ship/success/{order_id}', [OrderController::class, 'shipTosuccess'])->name('ship-success');
        Route::get('/delete/{id}', [OrderController::class, 'OrderDelete'])->name('order.delete');

        Route::get('/product/{product}', [OrderController::class, 'showProductOrders'])
            ->name('orders.byProduct');
        Route::get('/product/update/{product}', [OrderController::class, 'ProductOrderUpdate'])
            ->name('order.product.update');
    });
});


Route::post('/send-message', [ChatController::class, 'SendMessage']);
Route::get('/user-all', [ChatController::class, 'GetAllUsers']);
Route::get('/user-message/{id}', [ChatController::class, 'UserMsgById']);


Route::get('/offline', function () {
    return view('frontend.pages.offline.offline');
});


// CkEditor Upload Image Route
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:admin', 'PreventBackHistory']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::get('/send-email', function () {
    return view('email.register');
});
