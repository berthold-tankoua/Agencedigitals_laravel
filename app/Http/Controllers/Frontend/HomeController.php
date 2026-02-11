<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Category,
    Blog,
    History,
    Currency,
    Formation,
    Service,
    Product,
    Review,
    Slider,
    WhyChooseUs
};
use Illuminate\Support\Facades\{Auth, Cache, Http, Mail};

use App\Utility\Utility;
use Carbon\Carbon;

class HomeController extends Controller
{


    /*=========================
    HOME PAGE OK
    =========================*/
    public function index()
    {

        return view('frontend.pages.home.index', [
            'categories'  => Category::latest()->get(),
            'blogs'  => Blog::latest()->limit(4)->get(),
            'services'  => Service::orderBy('service_name_fr', 'ASC')->get(),

        ]);
    }

    /*=========================
    FORMATION LISTS
    =========================*/

    public function FormationLists()
    {
        return view('frontend.pages.formation.formation_list', [
            'formations' => Formation::latest()->get()
        ]);
    }

    public function FormationCategories($id, $slug)
    {
        $category = Category::findOrFail($id);
        $categories = Category::orderBy('category_name_fr', 'ASC')->get();
        $formations = Formation::where('category_id', $id)->latest()->get();

        return  $formations->isNotEmpty() ? view('frontend.pages.categorie.categorie_view', compact('category', 'categories', 'formations')) : view('errors.405');
    }

    /*=========================
    SEARCH
    =========================*/

    public function SearchViewResult(Request $request)
    {
        $search = $request->title;
        $formations = Formation::where('name', 'LIKE', "%$search%")->latest()->get();
        $categories = Category::orderBy('category_name_fr', 'ASC')->get();
        return view('frontend.pages.formations.formation_search', compact('formations', 'search', 'categories'));
    }



    /*=========================
    CURRENCY OK
    =========================*/
    public function ChangeCurrency($code)
    {
        session()->put('system_default_currency_info', Currency::where('code', $code)->first());
        return back();
    }

    public function CurrencyDailyUpdate()
    {
        $lastUpdate = Currency::where('updated_at', '<', Carbon::now()->subDays(7))->first();

        if ($lastUpdate) {
            $rates = Http::get("https://v6.exchangerate-api.com/v6/da771a819ca0a1c752e6ede6/latest/XAF")['conversion_rates'];
            Currency::all()->each(
                fn($item) =>
                $item->update([
                    'exchange_rate' => $rates[$item->code] ?? $item->exchange_rate,
                    'updated_at'    => now()
                ])
            );
        }
        return ['status' => true];
    }

    /*=========================
    SERVICES  OK
    =========================*/
    public function ServiceDetails($id, $slug)
    {
        return view('frontend.pages.services.service_details', [
            'service' => Service::findOrFail($id)
        ]);
    }

    public function ServiceLists()
    {
        return view('frontend.pages.services.service_list', [
            'services' => Service::latest()->get()
        ]);
    }
}
