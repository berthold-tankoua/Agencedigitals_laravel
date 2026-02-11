@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Dashboard
@endsection

<!-- start main container -->
<main>
    <div id="page" class="clearfix">
        <div class="layout-wrap">

            <!-- sidebar dashboard -->
            <div class="sidebar-menu-dashboard">

                <div class="user-box">

                    <div class="user d-flex flex-column">
                        <div class="icon-box">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_13487_13661)">
                                    <path
                                        d="M10.0007 9.99947C10.9357 9.99947 11.8496 9.72222 12.627 9.20278C13.4044 8.68334 14.0103 7.94504 14.3681 7.08124C14.7259 6.21745 14.8196 5.26695 14.6372 4.34995C14.4547 3.43295 14.0045 2.59063 13.3434 1.92951C12.6823 1.26839 11.84 0.81816 10.923 0.635757C10.006 0.453354 9.05546 0.54697 8.19166 0.904766C7.32787 1.26256 6.58957 1.86847 6.07013 2.64586C5.55069 3.42326 5.27344 4.33723 5.27344 5.2722C5.27469 6.52556 5.77314 7.72723 6.65941 8.6135C7.54567 9.49976 8.74734 9.99821 10.0007 9.99947ZM10.0007 2.12068C10.624 2.12068 11.2333 2.30551 11.7516 2.65181C12.2699 2.9981 12.6738 3.4903 12.9123 4.06616C13.1509 4.64203 13.2133 5.27569 13.0917 5.88702C12.9701 6.49836 12.6699 7.05991 12.2292 7.50065C11.7884 7.9414 11.2269 8.24155 10.6155 8.36315C10.0042 8.48476 9.37054 8.42235 8.79468 8.18382C8.21881 7.94528 7.72661 7.54135 7.38032 7.02308C7.03403 6.50482 6.8492 5.89551 6.8492 5.2722C6.8492 4.43636 7.18123 3.63476 7.77225 3.04374C8.36328 2.45271 9.16488 2.12068 10.0007 2.12068Z"
                                        fill="white" />
                                    <path
                                        d="M10.0011 11.5762C8.12108 11.5783 6.31869 12.326 4.98934 13.6554C3.65999 14.9847 2.91224 16.7871 2.91016 18.6671C2.91016 18.876 2.99316 19.0764 3.14092 19.2242C3.28868 19.372 3.48908 19.455 3.69803 19.455C3.90699 19.455 4.10739 19.372 4.25515 19.2242C4.4029 19.0764 4.48591 18.876 4.48591 18.6671C4.48591 17.2044 5.06697 15.8016 6.10126 14.7673C7.13555 13.733 8.53835 13.1519 10.0011 13.1519C11.4638 13.1519 12.8666 13.733 13.9009 14.7673C14.9352 15.8016 15.5162 17.2044 15.5162 18.6671C15.5162 18.876 15.5992 19.0764 15.747 19.2242C15.8947 19.372 16.0951 19.455 16.3041 19.455C16.513 19.455 16.7134 19.372 16.8612 19.2242C17.009 19.0764 17.092 18.876 17.092 18.6671C17.0899 16.7871 16.3421 14.9847 15.0128 13.6554C13.6834 12.326 11.881 11.5783 10.0011 11.5762Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_13487_13661">
                                        <rect width="18.9091" height="18.9091" fill="white"
                                            transform="translate(0.546875 0.544922)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="content text-center">
                            <div class="caption-2 text">{{ $store->store_name }}</div>
                            <div class="text-white fw-6">{{ $store->store_email }}</div>
                        </div>

                    </div>
                </div>
                <div class="menu-box">
                    <div class="title fw-6">Menu</div>
                    <ul class="box-menu-dashboard">
                        <li class="nav-menu-item">
                            <a class="nav-menu-link" href="{{ route('user.subscription.view') }}">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.2">
                                        <path d="M6.75682 9.35156V15.64" stroke="#F1FAEE" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11.0342 6.34375V15.6412" stroke="#F1FAEE" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.2412 12.6758V15.6412" stroke="#F1FAEE" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.2939 1.83398H6.70346C3.70902 1.83398 1.83203 3.95339 1.83203 6.95371V15.0476C1.83203 18.0479 3.70029 20.1673 6.70346 20.1673H15.2939C18.2971 20.1673 20.1654 18.0479 20.1654 15.0476V6.95371C20.1654 3.95339 18.2971 1.83398 15.2939 1.83398Z"
                                            stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                                Abonnement
                            </a>
                        </li>
                        <li class="nav-menu-item active">
                            <a class="nav-menu-link" href="{{ url('/agent/dashboard') }}">
                                <svg width="20" height="20" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.2">
                                        <path d="M6.75682 9.35156V15.64" stroke="#F1FAEE" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11.0342 6.34375V15.6412" stroke="#F1FAEE" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.2412 12.6758V15.6412" stroke="#F1FAEE" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.2939 1.83398H6.70346C3.70902 1.83398 1.83203 3.95339 1.83203 6.95371V15.0476C1.83203 18.0479 3.70029 20.1673 6.70346 20.1673H15.2939C18.2971 20.1673 20.1654 18.0479 20.1654 15.0476V6.95371C20.1654 3.95339 18.2971 1.83398 15.2939 1.83398Z"
                                            stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-menu-item">
                            <a class="nav-menu-link" href="{{ route('agent.edit') }}">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.2">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.987 14.0684C7.44168 14.0684 4.41406 14.6044 4.41406 16.7511C4.41406 18.8979 7.42247 19.4531 10.987 19.4531C14.5323 19.4531 17.5591 18.9162 17.5591 16.7703C17.5591 14.6245 14.5515 14.0684 10.987 14.0684Z"
                                            stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.9866 11.0056C13.3132 11.0056 15.1989 9.11897 15.1989 6.79238C15.1989 4.46579 13.3132 2.58008 10.9866 2.58008C8.66005 2.58008 6.77346 4.46579 6.77346 6.79238C6.7656 9.11111 8.6391 10.9977 10.957 11.0056H10.9866Z"
                                            stroke="#F1FAEE" stroke-width="1.42857" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                                Mon profil
                            </a>
                        </li>
                        <li class="nav-menu-item">
                            <a class="nav-menu-link" href="{{ url('/agent/chat/messages/view') }}">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.2">
                                        <path
                                            d="M16.4076 8.11328L12.3346 11.4252C11.5651 12.0357 10.4824 12.0357 9.71285 11.4252L5.60547 8.11328"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.4985 19.25C18.2864 19.2577 20.1654 16.9671 20.1654 14.1518V7.85584C20.1654 5.04059 18.2864 2.75 15.4985 2.75H6.49891C3.711 2.75 1.83203 5.04059 1.83203 7.85584V14.1518C1.83203 16.9671 3.711 19.2577 6.49891 19.25H15.4985Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                                Messages
                            </a>
                        </li>
                        <!-- <li class="nav-menu-item">
                    <a class="nav-menu-link" href="message.html">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.2">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4808 17.4814C14.6793 20.2831 10.531 20.8885 7.13625 19.3185C6.6351 19.1167 6.22423 18.9537 5.83362 18.9537C4.74565 18.9601 3.39143 20.015 2.68761 19.3121C1.98379 18.6082 3.03952 17.2529 3.03952 16.1583C3.03952 15.7677 2.88291 15.3641 2.68116 14.862C1.11046 11.4678 1.71663 7.31811 4.5181 4.51726C8.09433 0.939714 13.9045 0.939714 17.4808 4.51634C21.0635 8.09941 21.057 13.9047 17.4808 17.4814Z" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.6105 11.3802H14.6187" stroke="#F1FAEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10.9347 11.3802H10.9429" stroke="#F1FAEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7.2589 11.3802H7.26715" stroke="#F1FAEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                        </svg>
                        Message
                    </a>
                </li> -->
                        <li class="nav-menu-item">
                            <a class="nav-menu-link" href="{{ url('/agent/property/view') }}">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.2">
                                        <path
                                            d="M10.533 2.55664H7.10561C4.28686 2.55664 2.51953 4.55222 2.51953 7.37739V14.9986C2.51953 17.8237 4.27861 19.8193 7.10561 19.8193H15.1943C18.0222 19.8193 19.7813 17.8237 19.7813 14.9986V11.3062"
                                            stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.09012 10.0111L14.9404 3.16086C15.7938 2.30836 17.177 2.30836 18.0305 3.16086L19.146 4.27644C19.9995 5.12986 19.9995 6.51403 19.146 7.36653L12.2628 14.2498C11.8897 14.6229 11.3837 14.8328 10.8557 14.8328H7.42188L7.50804 11.3678C7.52087 10.8581 7.72896 10.3723 8.09012 10.0111Z"
                                            stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M13.8984 4.21875L18.0839 8.40425" stroke="#F1FAEE" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                </svg>
                                Mes publications
                            </a>
                        </li>

                        <li class="nav-menu-item">
                            <a class="nav-menu-link" href="{{ route('user.logout') }}">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.2">
                                        <path
                                            d="M13.7627 6.77418V5.91893C13.7627 4.05352 12.2502 2.54102 10.3848 2.54102H5.91606C4.05156 2.54102 2.53906 4.05352 2.53906 5.91893V16.1214C2.53906 17.9868 4.05156 19.4993 5.91606 19.4993H10.394C12.2539 19.4993 13.7627 17.9914 13.7627 16.1315V15.2671"
                                            stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M19.9907 11.0208H8.95312" stroke="#F1FAEE" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17.3047 8.34766L19.9887 11.0197L17.3047 13.6927" stroke="#F1FAEE"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                </svg>
                                Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- end sidebar dashboard -->
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="button-show-hide show-mb cursor-pointer d-flex justify-content-between flex-wrap">
                        <span class="body-1" style="cursor: pointer">Afficher le menu</span>
                        @if ($iaNotif)
                            <div>
                                <a href="{{ url('/ia/request/list') }}" title="Afficher mes notifications"
                                    class="btn btn-outline-primary"><i class="fas fa-bell"></i> vous avez recu une
                                    notification</a>
                            </div>
                        @endif
                    </div>
                    <div class="flat-counter-v2 tf-counter">
                        <div class="counter-box">
                            <div class="box-icon">
                                <span class="icon icon-listing"></span>
                            </div>
                            <div class="content-box">
                                <div class="title-count text-variant-1">Publications</div>
                                <div class="box-count d-flex align-items-end">
                                    <!-- <h3 class="number fw-8" data-speed="2000" data-to="17" data-inviewport="yes">32</h3>       -->
                                    <h3 class="fw-8">{{ count($properties) }}</h3>
                                    <span class="text">/{{ $store->subscription->listing }} restantes</span>
                                </div>

                            </div>
                        </div>
                        <div class="counter-box">
                            <div class="box-icon">
                                <span class="icon icon-pending"></span>
                            </div>
                            @php

                                if (empty($store->expiry_date)) {
                                    # code...
                                    $diff = 'Indetermine';
                                } else {
                                    # code...
                                    $created = \Carbon\carbon::now();
                                    $expiry = \Carbon\carbon::CreateFromFormat('Y-m-d H:s:i', $store->expiry_date);
                                    $diff = $created->diffIndays($expiry);
                                }
                            @endphp
                            <div class="content-box">
                                <div class="title-count text-variant-1">Status</div>
                                <div class="box-count d-flex align-items-end">

                                    <h3 class="fw-8">{{ $diff }}</h3>
                                    <span class="text"> Jour(s) restant</span>
                                </div>
                            </div>
                        </div>
                        <div class="counter-box">
                            <div class="box-icon">
                                <span class="icon icon-favorite"></span>
                            </div>
                            <div class="content-box">
                                <div class="title-count text-variant-1">Favoris</div>
                                <div class="d-flex align-items-end">
                                    <!-- <h6 class="number" data-speed="2000" data-to="1" data-inviewport="yes">1</h6>  -->
                                    <h3 class="fw-8">00</h3>
                                </div>

                            </div>
                        </div>
                        <div class="counter-box">
                            <div class="box-icon">
                                <span class="icon icon-eye"></span>
                            </div>
                            <div class="content-box">
                                <div class="title-count text-variant-1">Visite(s)</div>
                                <div class="d-flex align-items-end">
                                    @php
                                        $totalviews = App\Models\Property::where('store_id', $store->id)->sum(
                                            'view_count',
                                        );
                                    @endphp
                                    <h3 class="fw-8">{{ $totalviews }}</h3>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="wrapper-content row">
                        <div class="col-xl-8">
                            <div class="widget-box-2 wd-listing ">

                                <h5 class="title">Mes publications</h5>
                                <div class="wd-filter">
                                    <div class="ip-group">
                                        <a class="btn btn-primary" href="{{ url('/agent/add/property') }}"> Publier
                                            un article</a>
                                    </div>
                                    <div class="ip-group">
                                        <div class="nice-select" tabindex="0"><span class="current">Trier</span>
                                            <ul class="list">
                                                <li data-value="1" class="option selected">Date</li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-4"><span
                                        class="text-primary fw-7">{{ count($properties) }}</span><span
                                        class="fw-6">Resultats</span></div>
                                <div class="wrap-table">
                                    <div class="table-responsive">

                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($properties as $property)
                                                    <tr class="file-delete">
                                                        <td>
                                                            <div class="listing-box">
                                                                <div class="images">
                                                                    <img style="height: 100px;width:100%;"
                                                                        src="{{ asset($property->property_thambnail) }}"
                                                                        alt="images">
                                                                </div>
                                                                <div class="content">
                                                                    <div class="title"><a
                                                                            href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}"
                                                                            class="link">{{ $property->property_name }}</a>
                                                                    </div>
                                                                    <div class="text-date">date:
                                                                        {{ Carbon\Carbon::parse($property->created_at)->diffForHumans() }}
                                                                    </div>
                                                                    <div class="text-btn text-primary">
                                                                        {{ App\Utility\Utility::currency_converter($property->selling_price) }}
                                                                        {{ App\Utility\Utility::currency_code() }}
                                                                    </div>
                                                                    <div>
                                                                        <ul class="meta-list d-flex"
                                                                            style="font-size:11px">
                                                                            @if ($property->suite_count > 0)
                                                                                <li
                                                                                    class="item d-flex me-2 align-items-center flex-column">
                                                                                    <i class="fas fa-couch"></i>
                                                                                    <span class="text-variant-1"><span
                                                                                            class="fw-6">{{ $property->suite_count }}</span>
                                                                                        Salon(s)</span>
                                                                                </li>
                                                                            @endif
                                                                            @if ($property->bedroom_count > 0)
                                                                                <li
                                                                                    class="item d-flex me-2 align-items-center flex-column">
                                                                                    <i class="fas fa-bed"></i>
                                                                                    <span class="text-variant-1"><span
                                                                                            class="fw-6">{{ $property->bedroom_count }}</span>
                                                                                        Chambre(s)</span>
                                                                                </li>
                                                                            @endif
                                                                            @if ($property->bathroom_count > 0)
                                                                                <li
                                                                                    class="item d-flex me-2 align-items-center flex-column">
                                                                                    <i class="fas fa-bath"></i>
                                                                                    <span class="text-variant-1"><span
                                                                                            class="fw-6">{{ $property->bathroom_count }}</span>
                                                                                        Douche(s)</span>
                                                                                </li>
                                                                            @endif
                                                                            @if ($property->kitchen_count > 0)
                                                                                <li
                                                                                    class="item d-flex me-2 align-items-center flex-column">
                                                                                    <i class="fas fa-utensils"></i>
                                                                                    <span class="text-variant-1"><span
                                                                                            class="fw-6">{{ $property->kitchen_count }}</span>
                                                                                        Cuisine(s)</span>
                                                                                </li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="status-wrap">
                                                                @if ($property->status == 1)
                                                                    <a href="#" class="btn-status"> Active</a>
                                                                @elseif($property->status == 2)
                                                                    <a href="#" class="btn-danger"> Inactive</a>
                                                                @else
                                                                    <span class="badge badge-pill badge-danger">
                                                                        InActive </span>
                                                                @endif

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <ul class="list-action">
                                                                <li><a href="{{ route('agent.property.edit', $property->id) }}"
                                                                        class="item">
                                                                        <svg width="16" height="16"
                                                                            viewBox="0 0 16 16" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M11.2413 2.9915L12.366 1.86616C12.6005 1.63171 12.9184 1.5 13.25 1.5C13.5816 1.5 13.8995 1.63171 14.134 1.86616C14.3685 2.10062 14.5002 2.4186 14.5002 2.75016C14.5002 3.08173 14.3685 3.39971 14.134 3.63416L4.55467 13.2135C4.20222 13.5657 3.76758 13.8246 3.29 13.9668L1.5 14.5002L2.03333 12.7102C2.17552 12.2326 2.43442 11.7979 2.78667 11.4455L11.242 2.9915H11.2413ZM11.2413 2.9915L13 4.75016"
                                                                                stroke="#A3ABB0"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                        </svg>
                                                                        Modifier</a>
                                                                </li>
                                                                <li><a href="" class="item">
                                                                        <svg width="16" height="16"
                                                                            viewBox="0 0 16 16" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M12.2427 12.2427C13.3679 11.1175 14.0001 9.59135 14.0001 8.00004C14.0001 6.40873 13.3679 4.8826 12.2427 3.75737C11.1175 2.63214 9.59135 2 8.00004 2C6.40873 2 4.8826 2.63214 3.75737 3.75737M12.2427 12.2427C11.1175 13.3679 9.59135 14.0001 8.00004 14.0001C6.40873 14.0001 4.8826 13.3679 3.75737 12.2427C2.63214 11.1175 2 9.59135 2 8.00004C2 6.40873 2.63214 4.8826 3.75737 3.75737M12.2427 12.2427L3.75737 3.75737"
                                                                                stroke="#A3ABB0"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                        </svg>

                                                                        Desactiver</a>
                                                                </li>
                                                                <li><a href="{{ route('agent.property.delete', $property->id) }}"
                                                                        id="delete" class="remove-file item">
                                                                        <svg width="16" height="16"
                                                                            viewBox="0 0 16 16" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M9.82667 6.00035L9.596 12.0003M6.404 12.0003L6.17333 6.00035M12.8187 3.86035C13.0467 3.89501 13.2733 3.93168 13.5 3.97101M12.8187 3.86035L12.1067 13.1157C12.0776 13.4925 11.9074 13.8445 11.63 14.1012C11.3527 14.3579 10.9886 14.5005 10.6107 14.5003H5.38933C5.0114 14.5005 4.64735 14.3579 4.36999 14.1012C4.09262 13.8445 3.92239 13.4925 3.89333 13.1157L3.18133 3.86035M12.8187 3.86035C12.0492 3.74403 11.2758 3.65574 10.5 3.59568M3.18133 3.86035C2.95333 3.89435 2.72667 3.93101 2.5 3.97035M3.18133 3.86035C3.95076 3.74403 4.72416 3.65575 5.5 3.59568M10.5 3.59568V2.98501C10.5 2.19835 9.89333 1.54235 9.10667 1.51768C8.36908 1.49411 7.63092 1.49411 6.89333 1.51768C6.10667 1.54235 5.5 2.19901 5.5 2.98501V3.59568M10.5 3.59568C8.83581 3.46707 7.16419 3.46707 5.5 3.59568"
                                                                                stroke="#A3ABB0"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                        </svg>
                                                                        Supprimer</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="wd-navigation">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4">
                            <div class="widget-box-2 mess-box mb-20">
                                <div id="app">
                                    <chat-contact></chat-contact>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="overlay-dashboard"></div>

        </div>
    </div>
</main>
<!-- end main container -->
@endsection
