@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | {{ $store->store_name }}
@endsection

<main class="container">
    <section class="flat-section-v3 flat-property-detail">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <section class="wrapper-layout layout-2">
                        <div class="box-title-listing">
                            <h5 class="fw-8">{{ $store->store_name }} | Publications </h5>
                            <div class="box-filter-tab">
                                <ul class="nav-tab-filter" role="tablist">
                                    <li class="nav-tab-item" role="presentation">
                                        <a href="#gridLayout" class="nav-link-item active" data-bs-toggle="tab">
                                            <svg class="icon" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.54883 5.90508C4.54883 5.1222 5.17272 4.5 5.91981 4.5C6.66686 4.5 7.2908 5.12221 7.2908 5.90508C7.2908 6.68801 6.66722 7.3101 5.91981 7.3101C5.17241 7.3101 4.54883 6.68801 4.54883 5.90508Z"
                                                    stroke="#A3ABB0" />
                                                <path
                                                    d="M10.6045 5.90508C10.6045 5.12221 11.2284 4.5 11.9755 4.5C12.7229 4.5 13.3466 5.1222 13.3466 5.90508C13.3466 6.68789 12.7227 7.3101 11.9755 7.3101C11.2284 7.3101 10.6045 6.68794 10.6045 5.90508Z"
                                                    stroke="#A3ABB0" />
                                                <path
                                                    d="M19.4998 5.90514C19.4998 6.68797 18.8757 7.31016 18.1288 7.31016C17.3818 7.31016 16.7578 6.68794 16.7578 5.90508C16.7578 5.12211 17.3813 4.5 18.1288 4.5C18.8763 4.5 19.4998 5.12215 19.4998 5.90514Z"
                                                    stroke="#A3ABB0" />
                                                <path
                                                    d="M7.24249 12.0098C7.24249 12.7927 6.61849 13.4148 5.87133 13.4148C5.12411 13.4148 4.5 12.7926 4.5 12.0098C4.5 11.2268 5.12419 10.6045 5.87133 10.6045C6.61842 10.6045 7.24249 11.2267 7.24249 12.0098Z"
                                                    stroke="#A3ABB0" />
                                                <path
                                                    d="M13.2976 12.0098C13.2976 12.7927 12.6736 13.4148 11.9266 13.4148C11.1795 13.4148 10.5557 12.7928 10.5557 12.0098C10.5557 11.2266 11.1793 10.6045 11.9266 10.6045C12.6741 10.6045 13.2976 11.2265 13.2976 12.0098Z"
                                                    stroke="#A3ABB0" />
                                                <path
                                                    d="M19.4516 12.0098C19.4516 12.7928 18.828 13.4148 18.0807 13.4148C17.3329 13.4148 16.709 12.7926 16.709 12.0098C16.709 11.2268 17.3332 10.6045 18.0807 10.6045C18.8279 10.6045 19.4516 11.2266 19.4516 12.0098Z"
                                                    stroke="#A3ABB0" />
                                                <path
                                                    d="M4.54297 18.0945C4.54297 17.3116 5.16709 16.6895 5.9143 16.6895C6.66137 16.6895 7.28523 17.3114 7.28523 18.0945C7.28523 18.8776 6.66139 19.4996 5.9143 19.4996C5.16714 19.4996 4.54297 18.8771 4.54297 18.0945Z"
                                                    stroke="#A3ABB0" />
                                                <path
                                                    d="M10.5986 18.0945C10.5986 17.3116 11.2227 16.6895 11.97 16.6895C12.7169 16.6895 13.3409 17.3115 13.3409 18.0945C13.3409 18.8776 12.7169 19.4996 11.97 19.4996C11.2225 19.4996 10.5986 18.8772 10.5986 18.0945Z"
                                                    stroke="#A3ABB0" />
                                                <path
                                                    d="M16.752 18.0945C16.752 17.3115 17.376 16.6895 18.1229 16.6895C18.8699 16.6895 19.4939 17.3115 19.4939 18.0945C19.4939 18.8776 18.8702 19.4996 18.1229 19.4996C17.376 19.4996 16.752 18.8772 16.752 18.0945Z"
                                                    stroke="#A3ABB0" />
                                            </svg>

                                        </a>
                                    </li>
                                    <li class="nav-tab-item" role="presentation">
                                        <a href="#listLayout" class="nav-link-item" data-bs-toggle="tab">
                                            <svg class="icon" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2016 17.8316H8.50246C8.0615 17.8316 7.7041 17.4742 7.7041 17.0332C7.7041 16.5923 8.0615 16.2349 8.50246 16.2349H19.2013C19.6423 16.2349 19.9997 16.5923 19.9997 17.0332C19.9997 17.4742 19.6426 17.8316 19.2016 17.8316Z"
                                                    fill="#A3ABB0" />
                                                <path
                                                    d="M19.2016 12.8199H8.50246C8.0615 12.8199 7.7041 12.4625 7.7041 12.0215C7.7041 11.5805 8.0615 11.2231 8.50246 11.2231H19.2013C19.6423 11.2231 19.9997 11.5805 19.9997 12.0215C20 12.4625 19.6426 12.8199 19.2016 12.8199Z"
                                                    fill="#A3ABB0" />
                                                <path
                                                    d="M19.2016 7.80913H8.50246C8.0615 7.80913 7.7041 7.45173 7.7041 7.01077C7.7041 6.5698 8.0615 6.2124 8.50246 6.2124H19.2013C19.6423 6.2124 19.9997 6.5698 19.9997 7.01077C19.9997 7.45173 19.6426 7.80913 19.2016 7.80913Z"
                                                    fill="#A3ABB0" />
                                                <path
                                                    d="M5.0722 8.1444C5.66436 8.1444 6.1444 7.66436 6.1444 7.0722C6.1444 6.48004 5.66436 6 5.0722 6C4.48004 6 4 6.48004 4 7.0722C4 7.66436 4.48004 8.1444 5.0722 8.1444Z"
                                                    fill="#A3ABB0" />
                                                <path
                                                    d="M5.0722 13.0941C5.66436 13.0941 6.1444 12.6141 6.1444 12.0219C6.1444 11.4297 5.66436 10.9497 5.0722 10.9497C4.48004 10.9497 4 11.4297 4 12.0219C4 12.6141 4.48004 13.0941 5.0722 13.0941Z"
                                                    fill="#A3ABB0" />
                                                <path
                                                    d="M5.0722 18.0433C5.66436 18.0433 6.1444 17.5633 6.1444 16.9711C6.1444 16.379 5.66436 15.8989 5.0722 15.8989C4.48004 15.8989 4 16.379 4 16.9711C4 17.5633 4.48004 18.0433 5.0722 18.0433Z"
                                                    fill="#A3ABB0" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                                <div class="nice-select select-filter list-sort" tabindex="0"><span
                                        class="current">Trier Par (Plus Recent)</span>
                                    <ul class="list">
                                        <li data-value="default" class="option ">Trier Par (Plus Recent)</li>
                                        <li data-value="new" class="option">Plus Recent</li>
                                        <li data-value="old" class="option">Plus Ancien</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="flat-animate-tab">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="gridLayout" role="tabpanel">
                                    <div class="row">
                                        @foreach ($properties as $property)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="homelengo-box">
                                                    <div class="archive-top">
                                                        <a href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}"
                                                            class="images-group">
                                                            <div class="images-style">
                                                                <img class="lazyload"
                                                                    data-src="{{ asset($property->property_thambnail) }}"
                                                                    src="{{ asset($property->property_thambnail) }}"
                                                                    alt="img">
                                                            </div>
                                                            <div class="top">
                                                                <ul class="d-flex gap-6">
                                                                    <li class="flag-tag primary">
                                                                        {{ $property->action_type1 }}</li>
                                                                    <li class="flag-tag style-1">
                                                                        {{ $property->finality }}</li>
                                                                </ul>
                                                            </div>
                                                            <div class="bottom text-capitalize">
                                                                <svg width="16" height="16" viewBox="0 0 16 16"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7Z"
                                                                        stroke="white" stroke-width="1.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M13 7C13 11.7613 8 14.5 8 14.5C8 14.5 3 11.7613 3 7C3 5.67392 3.52678 4.40215 4.46447 3.46447C5.40215 2.52678 6.67392 2 8 2C9.32608 2 10.5979 2.52678 11.5355 3.46447C12.4732 4.40215 13 5.67392 13 7Z"
                                                                        stroke="white" stroke-width="1.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                                <div
                                                                    style="height:20px;overflow:hidden;text-transform:capitalize;">
                                                                    {{ $property->country }}, {{ $property->city }} |
                                                                    {{ $property->street }}
                                                                </div>
                                                            </div>
                                                        </a>

                                                    </div>
                                                    <div class="archive-bottom">
                                                        <div class="content-top">
                                                            <h7 class="text-nones"><a
                                                                    style="height:20px;overflow:hidden;width:100%;"
                                                                    href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}"
                                                                    class="link"> {{ $property->property_name }}</a>
                                                            </h7>
                                                            <ul class="meta-list" style="font-size:13px">
                                                                @if ($property->suite_count > 0)
                                                                    <li
                                                                        class="item d-flex align-items-center flex-column">
                                                                        <i class="fas fa-couch"></i>
                                                                        <span class="text-variant-1"><span
                                                                                class="fw-6">{{ $property->suite_count }}</span>
                                                                            Salon(s)</span>
                                                                    </li>
                                                                @endif
                                                                @if ($property->bedroom_count > 0)
                                                                    <li
                                                                        class="item d-flex align-items-center flex-column">
                                                                        <i class="fas fa-bed"></i>
                                                                        <span class="text-variant-1"><span
                                                                                class="fw-6">{{ $property->bedroom_count }}</span>
                                                                            Chambre(s)</span>
                                                                    </li>
                                                                @endif
                                                                @if ($property->bathroom_count > 0)
                                                                    <li
                                                                        class="item d-flex align-items-center flex-column">
                                                                        <i class="fas fa-bath"></i>
                                                                        <span class="text-variant-1"><span
                                                                                class="fw-6">{{ $property->bathroom_count }}</span>
                                                                            Douche(s)</span>
                                                                    </li>
                                                                @endif

                                                            </ul>
                                                        </div>
                                                        <div class="content-bottom">
                                                            <div class="d-flex gap-8 align-items-center">
                                                                <div class="avatar avt-40 round">
                                                                    <img src="{{ asset($property->store->store_thambnail) }}"
                                                                        alt="avt">
                                                                </div>
                                                                <span
                                                                    style="font-size: 12px">{{ $property->store->store_name }}</span>
                                                            </div>
                                                            <div class="d-flex">
                                                                <h6 class="price">
                                                                    {{ App\Utility\Utility::currency_converter($property->selling_price) }}
                                                                    {{ App\Utility\Utility::currency_code() }}</h6>
                                                                <span
                                                                    class="">{{ $property->action_type2 }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-center mb-20">
                                        <nav aria-label="Navigation Pagination text-center align-items-center "
                                            id="kpaginate">
                                            {{-- {{$properties->links()}} --}}
                                        </nav>
                                    </div>
                                </div>
                                <div class="tab-pane" id="listLayout" role="tabpanel">
                                    <div class="row">
                                        @foreach ($properties as $property)
                                            <div class="col-md-12">
                                                <div class="homelengo-box list-style-1 list-style-2 line">
                                                    <div class="archive-top">
                                                        <a href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}"
                                                            class="images-group">
                                                            <div class="images-style">
                                                                <img class="lazyload"
                                                                    data-src="{{ asset($property->property_thambnail) }}"
                                                                    src="{{ asset($property->property_thambnail) }}"
                                                                    alt="img-property">
                                                            </div>
                                                            <div class="top">
                                                                <ul class="d-flex gap-6 flex-wrap">
                                                                    <li class="flag-tag primary">
                                                                        {{ $property->action_type1 }}</li>
                                                                    <li class="flag-tag style-1">
                                                                        {{ $property->finality }}</li>
                                                                </ul>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="archive-bottom">
                                                        <div class="content-top">
                                                            <h6 class="text-capitalize"><a
                                                                    href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}"
                                                                    class="link text-line-clamp-1">
                                                                    {{ $property->property_name }}</a></h6>
                                                            <ul class="meta-list" style="font-size:13px">
                                                                @if ($property->suite_count > 0)
                                                                    <li
                                                                        class="item d-flex align-items-center flex-column">
                                                                        <i class="fas fa-couch"></i>
                                                                        <span class="text-variant-1"><span
                                                                                class="fw-6">{{ $property->suite_count }}</span>
                                                                            Salon(s)</span>
                                                                    </li>
                                                                @endif
                                                                @if ($property->bedroom_count > 0)
                                                                    <li
                                                                        class="item d-flex align-items-center flex-column">
                                                                        <i class="fas fa-bed"></i>
                                                                        <span class="text-variant-1"><span
                                                                                class="fw-6">{{ $property->bedroom_count }}</span>
                                                                            Chambre(s)</span>
                                                                    </li>
                                                                @endif
                                                                @if ($property->bathroom_count > 0)
                                                                    <li
                                                                        class="item d-flex align-items-center flex-column">
                                                                        <i class="fas fa-bath"></i>
                                                                        <span class="text-variant-1"><span
                                                                                class="fw-6">{{ $property->bathroom_count }}</span>
                                                                            Douche(s)</span>
                                                                    </li>
                                                                @endif
                                                                @if ($property->kitchen_count > 0)
                                                                    <li
                                                                        class="item d-flex align-items-center flex-column">
                                                                        <i class="fas fa-utensils"></i>
                                                                        <span class="text-variant-1"><span
                                                                                class="fw-6">{{ $property->kitchen_count }}</span>
                                                                            Cuisine(s)</span>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                            <div class="location">
                                                                <svg width="16" height="16"
                                                                    viewBox="0 0 16 16" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7Z"
                                                                        stroke="#A3ABB0" stroke-width="1.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M13 7C13 11.7613 8 14.5 8 14.5C8 14.5 3 11.7613 3 7C3 5.67392 3.52678 4.40215 4.46447 3.46447C5.40215 2.52678 6.67392 2 8 2C9.32608 2 10.5979 2.52678 11.5355 3.46447C12.4732 4.40215 13 5.67392 13 7Z"
                                                                        stroke="#A3ABB0" stroke-width="1.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                                <span class="text-line-clamp-1">
                                                                    {{ $property->country }}, {{ $property->city }} |
                                                                    {{ $property->street }} </span>
                                                            </div>
                                                        </div>

                                                        <div class="content-bottom">
                                                            <div class="d-flex gap-8 align-items-center">
                                                                <div class="avatar avt-40 round">
                                                                    <img src="{{ asset($property->store->store_thambnail) }}"
                                                                        alt="avt">
                                                                </div>
                                                                <span
                                                                    style="font-size: 12px">{{ $property->store->store_name }}</span>
                                                            </div>
                                                            <div class="d-flex">
                                                                <h6 class="price">
                                                                    {{ App\Utility\Utility::currency_converter($property->selling_price) }}
                                                                    {{ App\Utility\Utility::currency_code() }}</h6>
                                                                <span
                                                                    class="">{{ $property->action_type2 }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-center mb-20">
                                        <nav aria-label="Navigation Pagination text-center align-items-center "
                                            id="kpaginate">
                                            {{-- {{$properties->links()}} --}}
                                        </nav>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="single-sidebar fixed-sidebar">
                        <div class="widget-box single-property-contact">
                            <a target="_blank" rel="noopener noreferrer"
                                href="https://wa.me/{{ $store->store_contact }}/?text= Bonjour Mr/Mmme "
                                title="Contacter l agent par WhatsApp"
                                class="tf-btn btn-view btn primary hover-btn-view w-100" style="font-size:25px;"><span
                                    class="fab fa-whatsapp"></span> contacter le propriétaire</a>
                            <hr>
                            <h6 class="title fw-6">Contacter l’agent </h6>
                            <div class="box-avatar">
                                <div class="avatar avt-100 round">
                                    <img src="{{ asset($store->store_thambnail) }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <h6 class="name">{{ $store->store_name }}</h6>
                                    <ul class="list">
                                        <li class="d-flex align-items-center gap-4 text-variant-1"><i
                                                class="icon icon-phone"></i>{{ $store->store_contact }}</li>
                                        <li class="d-flex align-items-center gap-4 text-variant-1"><i
                                                class="icon icon-mail"></i>{{ $store->store_email }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="contact-form">
                                <div class="ip-group">
                                    <input type="text" name="user_name" id="user_name"
                                        placeholder="Saisir votre nom" class="form-control">
                                </div>
                                <div class="ip-group">
                                    <input type="tel" id="phone" name="phone" placeholder="ex 651009128"
                                        class="form-control">
                                    <input type="hidden" name="user_phone" id="user_phone">
                                </div>
                                <div class="ip-group">
                                    <input type="text" name="user_email" id="user_email"
                                        placeholder="Saisir votre email" class="form-control">
                                </div>
                                <div class="ip-group">
                                    <textarea name="user_message" id="user_message" rows="4" tabindex="4" placeholder="Message"
                                        aria-required="true"></textarea>
                                </div>
                                <button id="UserSendMsg" class="tf-btn btn-view primary hover-btn-view w-100">Envoyer
                                    Message <span class="icon icon-arrow-right2"></span></button>
                            </div>
                        </div>
                        <div class="flat-tab flat-tab-form widget-filter-search widget-box">

                        </div>
                        <div class="widget-box single-property-whychoose">
                            <h5 class="title fw-6">Pourquoi nous choisir.?</h5>
                            <ul class="box-whychoose">
                                <li class="item-why">
                                    <i class="icon icon-secure"></i>
                                    Réservation sécurisée
                                </li>
                                <li class="item-why">
                                    <i class="icon icon-guarantee"></i>
                                    Partenariats transparents
                                </li>
                                <li class="item-why">
                                    <i class="icon icon-booking"></i>
                                    Processus dématérialisés
                                </li>
                                <li class="item-why">
                                    <i class="icon icon-support"></i>
                                    Réactivité : Nous répondons rapidement à vos demandes
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</main>

<script>
    $("#UserSendMsg").click(function(e) {
        e.preventDefault();
        user_name = $("#user_name").val();
        user_email = $("#user_email").val();
        user_phone = $("#user_phone").val();
        user_indicatif = $("#user_indicatif").val();
        store_id = $("#store_id").val();
        property_id = $("#property_id").val();
        user_message = $("#user_message").val();
        link = $("#link").val();

        var data = new FormData();
        data.append('user_name', user_name);
        data.append('user_email', user_email);
        data.append('user_phone', user_phone);
        data.append('user_indicatif', user_indicatif);
        data.append('store_id', store_id);
        data.append('property_id', property_id);
        data.append('link', link);
        data.append('user_message', user_message);

        $.ajax({
            url: "/client/send/msg",
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        popup: 'my-toast-font'
                    }
                })

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }

            }

        }); // end ajax

    }); // end one
</script>
@endsection
