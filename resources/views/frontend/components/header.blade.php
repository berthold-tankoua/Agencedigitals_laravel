@php
    $currentPath = request()->path();
@endphp
@php
    App\Utility\Utility::currency_load();
    $currency_code = session('currency_code');
    $currency_symbol = session('currency_symbol');
    $currency_exchange = session('currency_exchange');
    if (empty($currency_code)) {
        $sysyem_default_currency_info = session('system_default_currency_info');
        $currency_code = $sysyem_default_currency_info->code;
        $currency_symbol = $sysyem_default_currency_info->symbol;
        $currency_exchange = $sysyem_default_currency_info->exchange_rate;
    }
@endphp

<div class="header_top d-none d-lg-block bg-dark">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ul class="list-unstyled mb-0 pr-0 d-flex">
                <li class="float-left">
                    <a class="btn btn-dark" href="{{ url('/contact') }}" title="Laissez nousun message">
                        <i class="far fa-message me-1"></i> Nous contacter
                    </a>
                </li>

                <li class="float-left">
                    <button id="btnInstall" class="btn btn-dark" title="Installer l'application">
                        <i class="fa fa-download" style="padding-right: 5px;"></i> Installer
                    </button>
                </li>
            </ul>

            <ul class="list-unstyled mb-0 pr-0 align-items-center d-flex">
                <li class="float-left">
                    <a class="btn btn-dark" href="{{ $about->facebook_link }}" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>

                <li class="float-left">
                    <a class="btn btn-dark" target="_blank" rel="noopener noreferrer"
                        href="https://wa.me/+19423888634/?text=j aimerai en savoir plus sur AgenceDigitals "
                        title="Whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </li>
                <li>

                </li>
                <div id="google_translate_element" style="display: none;"></div>
                <li class="dropdown  me-3 cursor-pointer">
                    <div id="langueBtn" class="dropdown-toggle"style="color: white;z-index:1000000" type="button"
                        data-bs-toggle="dropdown">
                        Langue
                    </div>
                    <ul class="dropdown-menu " style="cursor: pointer;z-index:1000000;">
                        <li data-lang="fr">
                            <div class="dropdown-item"><span class="flag-icon flag-icon-fr"> </span> Francais</div>
                        </li>
                        <li data-lang="en">
                            <div class="dropdown-item"><span class="flag-icon flag-icon-us"> </span> Anglais</div>
                        </li>
                    </ul>
                </li>

                <li class="dropdown  me-3">
                    <div class="dropdown-toggle"style="color: white;" type="button" data-bs-toggle="dropdown">
                        {{ $currency_code }}
                    </div>
                    @if (!request()->is('checkout*'))
                        <ul class="dropdown-menu cursor-pointer" style="cursor: pointer;z-index:10000;">
                            @php
                                $currencies = App\Models\Currency::get();
                            @endphp
                            @foreach ($currencies as $currency)
                                @if ($currency->code != $currency_code)
                                    <li><a href="{{ url('/currency/change/' . $currency->code) }}"
                                            class="dropdown-item">{{ $currency->name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </li>

            </ul>
        </div>
    </div>
</div>

<header class="transparent header-light header-float" style="z-index:10 !important">
    <div class="container-float">
        <div class="row">
            <div class="col-md-12">
                <div class="header-inner">
                    <div class="de-flex sm-pt10">
                        <div class="de-flex-col">
                            <!-- logo begin -->
                            <div id="logo">
                                <a href="index.html">
                                    <img class="logo-main" src="{{ asset('frontend/images/logo.webp') }}"
                                        alt="">
                                    <img class="logo-scroll" src="{{ asset('frontend/images/logo.webp') }}"
                                        alt="">
                                    <img class="logo-mobile" src="{{ asset('frontend/images/logo.webp') }}"
                                        alt="">
                                </a>
                            </div>
                            <!-- logo close -->
                        </div>
                        <div class="de-flex-col header-col-mid">
                            <ul id="mainmenu">
                                <li><a class="menu-item" href="{{ url('/') }}">Accueil</a></li>
                                <li><a class="menu-item" href="{{ url('/service/list') }}">Nos services</a>
                                    @php
                                        $services = App\Models\Service::orderBy('service_name_fr', 'ASC')->get();
                                    @endphp
                                    <ul>
                                        @foreach ($services as $service)
                                            <li><a class="menu-item"
                                                    href="{{ url('service/details/' . $service->id . '/' . $service->service_slug_fr) }}">{{ $service->service_name_fr }}</a>
                                            </li>
                                        @endforeach


                                    </ul>
                                </li>
                                <li><a class="menu-item" href="#">Nos projets</a></li>
                                <li><a class="menu-item" href="{{ url('/formation/list') }}">Nos formations</a>
                                    @php
                                        $categories = App\Models\Category::orderBy('category_name_fr', 'ASC')->get();
                                    @endphp
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li><a class="menu-item"
                                                    href="{{ url('formation/category/' . $category->id . '/' . $category->category_slug_fr) }}"><img
                                                        src="{{ asset($category->category_image) }}" alt=""
                                                        style="width: 15px; height: 15px; margin-right: 5px;">
                                                    {{ $category->category_name_fr }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a class="menu-item" href="{{ url('/about') }}">A propos</a></li>
                            </ul>
                        </div>
                        <div class="de-flex-col">
                            <div class="menu_side_area">
                                <a class="btn-main fx-slide" href="{{ url('/contact') }}"><span>Audit
                                        gratuit</span></a>
                                <span id="menu-btn"></span>
                            </div>

                            <div id="btn-extra" class="img">
                                <img src="{{ asset('frontend/images/ui/dots.svg') }}" class="" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
