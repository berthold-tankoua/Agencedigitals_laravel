<div class="mbl-nav">
    <div id="tab-favoris" class="navcontent">
        <div style="margin-top:55px;"><br>
            <h4>❤️ Favoris</h4>
            <p>Voici vos destinations favorites...</p>
        </div>
        <hr>
        @auth
            @php
                $wishlists = App\Models\Wishlist::where('user_id', Auth::id())->latest()->limit(4)->get();
            @endphp
            @if (count($wishlists) <= 0)
                <p class="text-center text-danger">AUCUN FAVORIS DISPONIBLE</p>
            @else
                <div class="widget-box box-latest-property">
                    <ul>
                        @foreach ($wishlists as $item)
                            <li class="latest-property-item">
                                <a href="{{ url('property/details/' . $item->property->id . '/' . $item->property->property_slug) }}"
                                    class="images-style">
                                    <img src="{{ asset($item->property->property_thambnail) }}" alt="img">
                                </a>
                                <div class="content">
                                    <div class="text-capitalize text-btn"><a
                                            href="{{ url('property/details/' . $item->property->id . '/' . $item->property->property_slug) }}"
                                            class="link">{{ $item->property->property_name }}</a></div>
                                    <ul class="meta-list mt-6" style="font-size:11px">
                                        @if ($item->property->suite_count > 0)
                                            <li class="item d-flex align-items-center flex-column">
                                                <i class="fas fa-couch"></i>
                                                <span class="text-variant-1"><span
                                                        class="fw-6">{{ $item->property->suite_count }}</span>
                                                    Salon(s)</span>
                                            </li>
                                        @endif
                                        @if ($item->property->bedroom_count > 0)
                                            <li class="item d-flex align-items-center flex-column">
                                                <i class="fas fa-bed"></i>
                                                <span class="text-variant-1"><span
                                                        class="fw-6">{{ $item->property->bedroom_count }}</span>
                                                    Chambre(s)</span>
                                            </li>
                                        @endif
                                        @if ($item->property->bathroom_count > 0)
                                            <li class="item d-flex align-items-center flex-column">
                                                <i class="fas fa-bath"></i>
                                                <span class="text-variant-1"><span
                                                        class="fw-6">{{ $item->property->bathroom_count }}</span>
                                                    Douche(s)</span>
                                            </li>
                                        @endif

                                    </ul>
                                    <div class="d-flex">
                                        <h6 class="price">
                                            {{ App\Utility\Utility::currency_converter($item->property->selling_price) }}
                                            {{ App\Utility\Utility::currency_code() }}</h6>
                                        <span class="">{{ $item->property->action_type2 }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @else
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="flat-account bg-white" style="border-radius: 5px">
                        <form class="form-account" action="{{ route('user.check') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box">
                                <div class="text-center">
                                    <h2 class="font-weight-bold h4 text-center"><strong>AgenceDigitals</strong> Connexion
                                    </h2>
                                    <p class="tagline text-body mb-3 text-center">Saisir votre email & mot de passe pour
                                        vous connecter</p>
                                    <div class="d-flex justify-content-center">
                                        @if (session('fail'))
                                            <div class="alert alert-danger">
                                                {{ Session('fail') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <fieldset class="box-fieldset">
                                    <label>Votre Email</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.4869 14.0435C12.9628 13.3497 12.2848 12.787 11.5063 12.3998C10.7277 12.0126 9.86989 11.8115 9.00038 11.8123C8.13086 11.8115 7.27304 12.0126 6.49449 12.3998C5.71594 12.787 5.03793 13.3497 4.51388 14.0435M13.4869 14.0435C14.5095 13.1339 15.2307 11.9349 15.5563 10.6056C15.8818 9.27625 15.7956 7.87934 15.309 6.60014C14.8224 5.32093 13.9584 4.21986 12.8317 3.44295C11.7049 2.66604 10.3686 2.25 9 2.25C7.63137 2.25 6.29508 2.66604 5.16833 3.44295C4.04158 4.21986 3.17762 5.32093 2.69103 6.60014C2.20443 7.87934 2.11819 9.27625 2.44374 10.6056C2.76929 11.9349 3.49125 13.1339 4.51388 14.0435M13.4869 14.0435C12.2524 15.1447 10.6546 15.7521 9.00038 15.7498C7.3459 15.7523 5.74855 15.1448 4.51388 14.0435M11.2504 7.31228C11.2504 7.90902 11.0133 8.48131 10.5914 8.90327C10.1694 9.32523 9.59711 9.56228 9.00038 9.56228C8.40364 9.56228 7.83134 9.32523 7.40939 8.90327C6.98743 8.48131 6.75038 7.90902 6.75038 7.31228C6.75038 6.71554 6.98743 6.14325 7.40939 5.72129C7.83134 5.29933 8.40364 5.06228 9.00038 5.06228C9.59711 5.06228 10.1694 5.29933 10.5914 5.72129C11.0133 6.14325 11.2504 6.71554 11.2504 7.31228Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Saisir votre email">
                                    </div>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label>Votre Mot de Passe</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.375 7.875V5.0625C12.375 4.16739 12.0194 3.30895 11.3865 2.67601C10.7535 2.04308 9.89511 1.6875 9 1.6875C8.10489 1.6875 7.24645 2.04308 6.61351 2.67601C5.98058 3.30895 5.625 4.16739 5.625 5.0625V7.875M5.0625 16.3125H12.9375C13.3851 16.3125 13.8143 16.1347 14.1307 15.8182C14.4472 15.5018 14.625 15.0726 14.625 14.625V9.5625C14.625 9.11495 14.4472 8.68573 14.1307 8.36926C13.8143 8.05279 13.3851 7.875 12.9375 7.875H5.0625C4.61495 7.875 4.18573 8.05279 3.86926 8.36926C3.55279 8.68573 3.375 9.11495 3.375 9.5625V14.625C3.375 15.0726 3.55279 15.5018 3.86926 15.8182C4.18573 16.1347 4.61495 16.3125 5.0625 16.3125Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Saisir votre mot de passe">
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-forgot text-end"><a href="{{ route('user.forget-password') }}">Mot
                                                de passe oublie.?</a></div>
                                        <i class="fas fa-eye icon text-end"
                                            style="margin-left:-25px !important; float: right;" onclick="showpassword()"
                                            title="Afficer mot de passe"></i>
                                    </div>

                                </fieldset>
                            </div>
                            <div class="box box-btn">
                                <button type="submit" class="tf-btn primary w-100">Se connecter</button>
                                <div class="text text-center">Vous n'avez pas de compte? <a
                                        href="{{ route('user.register') }}" class="text-primary">S'inscrire</a></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @endauth
    </div>
    <div id="tab-voyages" class="navcontent">
        <div style="margin-top:55px;"><br>
            <h4>✈️ Voyages</h4>
            <p>Historique et organisation de vos voyages.</p>
        </div>
        <hr>
        @auth
            @php
                $histories = App\Models\History::where('user_id', Auth::id())->latest()->limit(4)->get();
            @endphp
            @if (count($histories) <= 0)
                <p class="text-center text-danger">AUCUN HISTORIQUE DISPONIBLE</p>
            @else
                <div class="widget-box box-latest-property">
                    <ul>
                        @foreach ($histories as $item)
                            <li class="latest-property-item">
                                <a href="{{ url('property/details/' . $item->property->id . '/' . $item->property->property_slug) }}"
                                    class="images-style">
                                    <img src="{{ asset($item->property->property_thambnail) }}" alt="img">
                                </a>
                                <div class="content">
                                    <div class="text-capitalize text-btn"><a
                                            href="{{ url('property/details/' . $item->property->id . '/' . $item->property->property_slug) }}"
                                            class="link">{{ $item->property->property_name }}</a></div>
                                    <ul class="meta-list mt-6" style="font-size:11px">
                                        @if ($item->property->suite_count > 0)
                                            <li class="item d-flex align-items-center flex-column">
                                                <i class="fas fa-couch"></i>
                                                <span class="text-variant-1"><span
                                                        class="fw-6">{{ $item->property->suite_count }}</span>
                                                    Salon(s)</span>
                                            </li>
                                        @endif
                                        @if ($item->property->bedroom_count > 0)
                                            <li class="item d-flex align-items-center flex-column">
                                                <i class="fas fa-bed"></i>
                                                <span class="text-variant-1"><span
                                                        class="fw-6">{{ $item->property->bedroom_count }}</span>
                                                    Chambre(s)</span>
                                            </li>
                                        @endif
                                        @if ($item->property->bathroom_count > 0)
                                            <li class="item d-flex align-items-center flex-column">
                                                <i class="fas fa-bath"></i>
                                                <span class="text-variant-1"><span
                                                        class="fw-6">{{ $item->property->bathroom_count }}</span>
                                                    Douche(s)</span>
                                            </li>
                                        @endif

                                    </ul>
                                    <div class="d-flex">
                                        <h6 class="price">
                                            {{ App\Utility\Utility::currency_converter($item->property->selling_price) }}
                                            {{ App\Utility\Utility::currency_code() }}</h6>
                                        <span class="">{{ $item->property->action_type2 }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @else
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="flat-account bg-white" style="border-radius: 5px">
                        <form class="form-account" action="{{ route('user.check') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box">
                                <div class="text-center">
                                    <h2 class="font-weight-bold h4 text-center"><strong>AgenceDigitals</strong> Connexion
                                    </h2>
                                    <p class="tagline text-body mb-3 text-center">Saisir votre email & mot de passe pour
                                        vous connecter</p>
                                    <div class="d-flex justify-content-center">
                                        @if (session('fail'))
                                            <div class="alert alert-danger">
                                                {{ Session('fail') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <fieldset class="box-fieldset">
                                    <label>Votre Email</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.4869 14.0435C12.9628 13.3497 12.2848 12.787 11.5063 12.3998C10.7277 12.0126 9.86989 11.8115 9.00038 11.8123C8.13086 11.8115 7.27304 12.0126 6.49449 12.3998C5.71594 12.787 5.03793 13.3497 4.51388 14.0435M13.4869 14.0435C14.5095 13.1339 15.2307 11.9349 15.5563 10.6056C15.8818 9.27625 15.7956 7.87934 15.309 6.60014C14.8224 5.32093 13.9584 4.21986 12.8317 3.44295C11.7049 2.66604 10.3686 2.25 9 2.25C7.63137 2.25 6.29508 2.66604 5.16833 3.44295C4.04158 4.21986 3.17762 5.32093 2.69103 6.60014C2.20443 7.87934 2.11819 9.27625 2.44374 10.6056C2.76929 11.9349 3.49125 13.1339 4.51388 14.0435M13.4869 14.0435C12.2524 15.1447 10.6546 15.7521 9.00038 15.7498C7.3459 15.7523 5.74855 15.1448 4.51388 14.0435M11.2504 7.31228C11.2504 7.90902 11.0133 8.48131 10.5914 8.90327C10.1694 9.32523 9.59711 9.56228 9.00038 9.56228C8.40364 9.56228 7.83134 9.32523 7.40939 8.90327C6.98743 8.48131 6.75038 7.90902 6.75038 7.31228C6.75038 6.71554 6.98743 6.14325 7.40939 5.72129C7.83134 5.29933 8.40364 5.06228 9.00038 5.06228C9.59711 5.06228 10.1694 5.29933 10.5914 5.72129C11.0133 6.14325 11.2504 6.71554 11.2504 7.31228Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Saisir votre email">
                                    </div>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label>Votre Mot de Passe</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.375 7.875V5.0625C12.375 4.16739 12.0194 3.30895 11.3865 2.67601C10.7535 2.04308 9.89511 1.6875 9 1.6875C8.10489 1.6875 7.24645 2.04308 6.61351 2.67601C5.98058 3.30895 5.625 4.16739 5.625 5.0625V7.875M5.0625 16.3125H12.9375C13.3851 16.3125 13.8143 16.1347 14.1307 15.8182C14.4472 15.5018 14.625 15.0726 14.625 14.625V9.5625C14.625 9.11495 14.4472 8.68573 14.1307 8.36926C13.8143 8.05279 13.3851 7.875 12.9375 7.875H5.0625C4.61495 7.875 4.18573 8.05279 3.86926 8.36926C3.55279 8.68573 3.375 9.11495 3.375 9.5625V14.625C3.375 15.0726 3.55279 15.5018 3.86926 15.8182C4.18573 16.1347 4.61495 16.3125 5.0625 16.3125Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Saisir votre mot de passe">
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-forgot text-end"><a
                                                href="{{ route('user.forget-password') }}">Mot de passe oublie.?</a></div>
                                        <i class="fas fa-eye icon text-end"
                                            style="margin-left:-25px !important; float: right;" onclick="showpassword()"
                                            title="Afficer mot de passe"></i>
                                    </div>

                                </fieldset>
                            </div>
                            <div class="box box-btn">
                                <button type="submit" class="tf-btn primary w-100">Se connecter</button>
                                <div class="text text-center">Vous n'avez pas de compte? <a
                                        href="{{ route('user.register') }}" class="text-primary">S'inscrire</a></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @endauth
    </div>

    <div id="tab-messages" class="navcontent">
        <div style="margin-top:35px;"><br>
        </div>
        <hr>
        @auth
            <div id="app">
                <chat-message></chat-message>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="flat-account bg-white" style="border-radius: 5px">
                        <form class="form-account" action="{{ route('user.check') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box">
                                <div class="text-center">
                                    <h2 class="font-weight-bold h4 text-center"><strong>AgenceDigitals</strong> Connexion
                                    </h2>
                                    <p class="tagline text-body mb-3 text-center">Saisir votre email & mot de passe pour
                                        vous connecter</p>
                                    <div class="d-flex justify-content-center">
                                        @if (session('fail'))
                                            <div class="alert alert-danger">
                                                {{ Session('fail') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <fieldset class="box-fieldset">
                                    <label>Votre Email</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.4869 14.0435C12.9628 13.3497 12.2848 12.787 11.5063 12.3998C10.7277 12.0126 9.86989 11.8115 9.00038 11.8123C8.13086 11.8115 7.27304 12.0126 6.49449 12.3998C5.71594 12.787 5.03793 13.3497 4.51388 14.0435M13.4869 14.0435C14.5095 13.1339 15.2307 11.9349 15.5563 10.6056C15.8818 9.27625 15.7956 7.87934 15.309 6.60014C14.8224 5.32093 13.9584 4.21986 12.8317 3.44295C11.7049 2.66604 10.3686 2.25 9 2.25C7.63137 2.25 6.29508 2.66604 5.16833 3.44295C4.04158 4.21986 3.17762 5.32093 2.69103 6.60014C2.20443 7.87934 2.11819 9.27625 2.44374 10.6056C2.76929 11.9349 3.49125 13.1339 4.51388 14.0435M13.4869 14.0435C12.2524 15.1447 10.6546 15.7521 9.00038 15.7498C7.3459 15.7523 5.74855 15.1448 4.51388 14.0435M11.2504 7.31228C11.2504 7.90902 11.0133 8.48131 10.5914 8.90327C10.1694 9.32523 9.59711 9.56228 9.00038 9.56228C8.40364 9.56228 7.83134 9.32523 7.40939 8.90327C6.98743 8.48131 6.75038 7.90902 6.75038 7.31228C6.75038 6.71554 6.98743 6.14325 7.40939 5.72129C7.83134 5.29933 8.40364 5.06228 9.00038 5.06228C9.59711 5.06228 10.1694 5.29933 10.5914 5.72129C11.0133 6.14325 11.2504 6.71554 11.2504 7.31228Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Saisir votre email">
                                    </div>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label>Votre Mot de Passe</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.375 7.875V5.0625C12.375 4.16739 12.0194 3.30895 11.3865 2.67601C10.7535 2.04308 9.89511 1.6875 9 1.6875C8.10489 1.6875 7.24645 2.04308 6.61351 2.67601C5.98058 3.30895 5.625 4.16739 5.625 5.0625V7.875M5.0625 16.3125H12.9375C13.3851 16.3125 13.8143 16.1347 14.1307 15.8182C14.4472 15.5018 14.625 15.0726 14.625 14.625V9.5625C14.625 9.11495 14.4472 8.68573 14.1307 8.36926C13.8143 8.05279 13.3851 7.875 12.9375 7.875H5.0625C4.61495 7.875 4.18573 8.05279 3.86926 8.36926C3.55279 8.68573 3.375 9.11495 3.375 9.5625V14.625C3.375 15.0726 3.55279 15.5018 3.86926 15.8182C4.18573 16.1347 4.61495 16.3125 5.0625 16.3125Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Saisir votre mot de passe">
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-forgot text-end"><a
                                                href="{{ route('user.forget-password') }}">Mot de passe oublie.?</a></div>
                                        <i class="fas fa-eye icon text-end"
                                            style="margin-left:-25px !important; float: right;" onclick="showpassword()"
                                            title="Afficer mot de passe"></i>
                                    </div>

                                </fieldset>
                            </div>
                            <div class="box box-btn">
                                <button type="submit" class="tf-btn primary w-100">Se connecter</button>
                                <div class="text text-center">Vous n'avez pas de compte? <a
                                        href="{{ route('user.register') }}" class="text-primary">S'inscrire</a></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @endauth

    </div>

    <div id="tab-profil" class="navcontent"><br>
        <div style="margin-top:55px;">
            @if (Auth::check())
                <h5 class="mb-2">👤 {{ Auth::user()->name }}</h5>
            @else
                <h4 class="mb-2">👤 Profil Utilisateur</h4>
            @endif
            <p>Informations personnelles et paramètres.</p>
        </div>
        <hr>
        @auth
            @php
                $hasStore = Auth::check() && App\Models\Store::where('user_id', Auth::id())->exists();
            @endphp
            <nav class="menu-box">
                <div class="bottom-canvas">

                    <div class="mobi-icon-box">
                        <div class="box d-flex align-items-center">
                            <span class="icon icon-user me-2"></span>
                            <div>{{ Auth::user()->name }}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="mobi-icon-box">
                        <div class="box d-flex align-items-center">
                            <span class="icon icon-phone2 me-2"></span>
                            <div>{{ Auth::user()->phone }}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="mobi-icon-box">
                        <div class="box d-flex align-items-center">
                            <span class="icon icon-mail me-2"></span>
                            <div>{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <hr><br>
                    <div class="text-center">
                        @if ($hasStore)
                            <a class="tf-btn primary" href="{{ url('/agent/dashboard') }}">
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.625 14.375V17.1875C13.625 17.705 13.205 18.125 12.6875 18.125H4.5625C4.31386 18.125 4.0754 18.0262 3.89959 17.8504C3.72377 17.6746 3.625 17.4361 3.625 17.1875V6.5625C3.625 6.045 4.045 5.625 4.5625 5.625H6.125C6.54381 5.62472 6.96192 5.65928 7.375 5.72834M13.625 14.375H16.4375C16.955 14.375 17.375 13.955 17.375 13.4375V9.375C17.375 5.65834 14.6725 2.57417 11.125 1.97834C10.7119 1.90928 10.2938 1.87472 9.875 1.875H8.3125C7.795 1.875 7.375 2.295 7.375 2.8125V5.72834M13.625 14.375H8.3125C8.06386 14.375 7.8254 14.2762 7.64959 14.1004C7.47377 13.9246 7.375 13.6861 7.375 13.4375V5.72834M17.375 11.25V9.6875C17.375 8.94158 17.0787 8.22621 16.5512 7.69876C16.0238 7.17132 15.3084 6.875 14.5625 6.875H13.3125C13.0639 6.875 12.8254 6.77623 12.6496 6.60041C12.4738 6.4246 12.375 6.18614 12.375 5.9375V4.6875C12.375 4.31816 12.3023 3.95243 12.1609 3.6112C12.0196 3.26998 11.8124 2.95993 11.5512 2.69876C11.2901 2.4376 10.98 2.23043 10.6388 2.08909C10.2976 1.94775 9.93184 1.875 9.5625 1.875H8.625"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Dashboard
                            </a>
                        @else
                            <a class="tf-btn primary" href="{{ url('/user/create/store/') }}">
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.625 14.375V17.1875C13.625 17.705 13.205 18.125 12.6875 18.125H4.5625C4.31386 18.125 4.0754 18.0262 3.89959 17.8504C3.72377 17.6746 3.625 17.4361 3.625 17.1875V6.5625C3.625 6.045 4.045 5.625 4.5625 5.625H6.125C6.54381 5.62472 6.96192 5.65928 7.375 5.72834M13.625 14.375H16.4375C16.955 14.375 17.375 13.955 17.375 13.4375V9.375C17.375 5.65834 14.6725 2.57417 11.125 1.97834C10.7119 1.90928 10.2938 1.87472 9.875 1.875H8.3125C7.795 1.875 7.375 2.295 7.375 2.8125V5.72834M13.625 14.375H8.3125C8.06386 14.375 7.8254 14.2762 7.64959 14.1004C7.47377 13.9246 7.375 13.6861 7.375 13.4375V5.72834M17.375 11.25V9.6875C17.375 8.94158 17.0787 8.22621 16.5512 7.69876C16.0238 7.17132 15.3084 6.875 14.5625 6.875H13.3125C13.0639 6.875 12.8254 6.77623 12.6496 6.60041C12.4738 6.4246 12.375 6.18614 12.375 5.9375V4.6875C12.375 4.31816 12.3023 3.95243 12.1609 3.6112C12.0196 3.26998 11.8124 2.95993 11.5512 2.69876C11.2901 2.4376 10.98 2.23043 10.6388 2.08909C10.2976 1.94775 9.93184 1.875 9.5625 1.875H8.625"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Lister une propriété
                            </a>
                        @endif
                        <br><br>
                        <a href="{{ route('user.logout') }}" class="tf-btn btn btn-danger">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.1251 5C13.1251 5.8288 12.7959 6.62366 12.2099 7.20971C11.6238 7.79576 10.8289 8.125 10.0001 8.125C9.17134 8.125 8.37649 7.79576 7.79043 7.20971C7.20438 6.62366 6.87514 5.8288 6.87514 5C6.87514 4.1712 7.20438 3.37634 7.79043 2.79029C8.37649 2.20424 9.17134 1.875 10.0001 1.875C10.8289 1.875 11.6238 2.20424 12.2099 2.79029C12.7959 3.37634 13.1251 4.1712 13.1251 5ZM3.75098 16.765C3.77776 15.1253 4.44792 13.5618 5.61696 12.4117C6.78599 11.2616 8.36022 10.6171 10.0001 10.6171C11.6401 10.6171 13.2143 11.2616 14.3833 12.4117C15.5524 13.5618 16.2225 15.1253 16.2493 16.765C14.2888 17.664 12.1569 18.1279 10.0001 18.125C7.77014 18.125 5.65348 17.6383 3.75098 16.765Z"
                                    stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Déconnexion
                        </a>
                    </div>
                </div>
            </nav>
        @else
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="flat-account bg-white" style="border-radius: 5px">
                        <form class="form-account" action="{{ route('user.check') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box">
                                <div class="text-center">
                                    <h2 class="font-weight-bold h4 text-center"><strong>AgenceDigitals</strong> Connexion
                                    </h2>
                                    <p class="tagline text-body mb-3 text-center">Saisir votre email & mot de passe pour
                                        vous connecter</p>
                                    <div class="d-flex justify-content-center">
                                        @if (session('fail'))
                                            <div class="alert alert-danger">
                                                {{ Session('fail') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <fieldset class="box-fieldset">
                                    <label>Votre Email</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.4869 14.0435C12.9628 13.3497 12.2848 12.787 11.5063 12.3998C10.7277 12.0126 9.86989 11.8115 9.00038 11.8123C8.13086 11.8115 7.27304 12.0126 6.49449 12.3998C5.71594 12.787 5.03793 13.3497 4.51388 14.0435M13.4869 14.0435C14.5095 13.1339 15.2307 11.9349 15.5563 10.6056C15.8818 9.27625 15.7956 7.87934 15.309 6.60014C14.8224 5.32093 13.9584 4.21986 12.8317 3.44295C11.7049 2.66604 10.3686 2.25 9 2.25C7.63137 2.25 6.29508 2.66604 5.16833 3.44295C4.04158 4.21986 3.17762 5.32093 2.69103 6.60014C2.20443 7.87934 2.11819 9.27625 2.44374 10.6056C2.76929 11.9349 3.49125 13.1339 4.51388 14.0435M13.4869 14.0435C12.2524 15.1447 10.6546 15.7521 9.00038 15.7498C7.3459 15.7523 5.74855 15.1448 4.51388 14.0435M11.2504 7.31228C11.2504 7.90902 11.0133 8.48131 10.5914 8.90327C10.1694 9.32523 9.59711 9.56228 9.00038 9.56228C8.40364 9.56228 7.83134 9.32523 7.40939 8.90327C6.98743 8.48131 6.75038 7.90902 6.75038 7.31228C6.75038 6.71554 6.98743 6.14325 7.40939 5.72129C7.83134 5.29933 8.40364 5.06228 9.00038 5.06228C9.59711 5.06228 10.1694 5.29933 10.5914 5.72129C11.0133 6.14325 11.2504 6.71554 11.2504 7.31228Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Saisir votre email">
                                    </div>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label>Votre Mot de Passe</label>
                                    <div class="ip-field">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.375 7.875V5.0625C12.375 4.16739 12.0194 3.30895 11.3865 2.67601C10.7535 2.04308 9.89511 1.6875 9 1.6875C8.10489 1.6875 7.24645 2.04308 6.61351 2.67601C5.98058 3.30895 5.625 4.16739 5.625 5.0625V7.875M5.0625 16.3125H12.9375C13.3851 16.3125 13.8143 16.1347 14.1307 15.8182C14.4472 15.5018 14.625 15.0726 14.625 14.625V9.5625C14.625 9.11495 14.4472 8.68573 14.1307 8.36926C13.8143 8.05279 13.3851 7.875 12.9375 7.875H5.0625C4.61495 7.875 4.18573 8.05279 3.86926 8.36926C3.55279 8.68573 3.375 9.11495 3.375 9.5625V14.625C3.375 15.0726 3.55279 15.5018 3.86926 15.8182C4.18573 16.1347 4.61495 16.3125 5.0625 16.3125Z"
                                                stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Saisir votre mot de passe">
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-forgot text-end"><a
                                                href="{{ route('user.forget-password') }}">Mot de passe oublie.?</a></div>
                                        <i class="fas fa-eye icon text-end"
                                            style="margin-left:-25px !important; float: right;" onclick="showpassword()"
                                            title="Afficer mot de passe"></i>
                                    </div>

                                </fieldset>
                            </div>
                            <div class="box box-btn">
                                <button type="submit" class="tf-btn primary w-100">Se connecter</button>
                                <div class="text text-center">Vous n'avez pas de compte? <a
                                        href="{{ route('user.register') }}" class="text-primary">S'inscrire</a></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @endauth
    </div>
    <!-- Navigation -->
    <div class="bottom-nav">
        <div class="navs-item active" data-tab="parcourir">
            <svg viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            <div>Parcourir</div>
        </div>
        <div class="navs-item" data-tab="favoris">
            <svg viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                 2 6 4 4 6.5 4c1.74 0 3.41 1.1 4.13 2.44C11.09 5.1
                 12.76 4 14.5 4 17 4 19 6 19 8.5c0 3.78-3.4 6.86-8.55
                 11.54L12 21.35z" />
            </svg>
            <div>Favoris</div>
        </div>
        <div class="navs-item" data-tab="voyages">
            <svg viewBox="0 0 24 24">
                <path d="M12 2C8 6 4 10 4 14s3 8 8 8 8-4 8-8-4-8-8-12z" />
            </svg>
            <div>Voyages</div>
        </div>
        <div class="navs-item" data-tab="messages">
            <div class="navs-item-wrapper">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2
                   2 0 0 1 2 2z" />
                </svg>
                <span class="badge"></span>
            </div>
            <div>Messages</div>
        </div>
        <div class="navs-item" data-tab="profil">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4" />
                <path d="M6 20c0-2 4-3 6-3s6 1 6 3" />
            </svg>
            <div>Profil</div>
        </div>
    </div>
</div>

<script>
    const navItems = document.querySelectorAll('.navs-item');
    const navcontents = document.querySelectorAll('.navcontent');

    navItems.forEach(item => {
        item.addEventListener('click', () => {
            const tabName = item.getAttribute('data-tab');
            const targetnavContent = document.getElementById('tab-' + tabName);

            const isActive = item.classList.contains('active');

            navItems.forEach(i => i.classList.remove('active'));
            navcontents.forEach(c => c.classList.remove('active'));

            if (!isActive) {
                item.classList.add('active');
                targetnavContent.classList.add('active');

            }
        });
    });
</script>
