@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Tous nos Agents
@endsection
<!-- start main container -->
<main class="bg-light" id="main">
    <section>

        <div class="container py-5">
            <div class="box-title-listing d-flex">
                <h3 class="fw-8">Nos Agents </h3>
                <div class="box-filter-tab">
                    <form action="{{ route('agent.place.filter') }}" method="GET" class="d-flex align-items-center">
                        @csrf
                        <div class="form-group me-3">
                            <label for="place">Recherche d'agent par lieu</label>
                            <input type="text" class="form-control" style="border-radius: 5px !important;"
                                name="place" id="place" placeholder="Saisir une ville ou quartier">
                        </div>
                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary"><i class=" icon icon-search"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row pt-3 justify-content-center">
                @foreach ($agents as $store)
                    <!-- Agent 1 -->
                    <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
                        <div class="swiper-slide">
                            <div class="box-agent style-list hover-img hover-btn-view lg-col-3">
                                <div class="archive-content">
                                    <div class="top d-flex ">
                                        <img width="60px" height="60px" class="lazyload me-2"
                                            data-src="{{ asset($store->store_thambnail) }}"
                                            src="{{ asset($store->store_thambnail) }}" alt="image-agent">
                                        <div class="ml-3">
                                            <h6><a href="{{ url('/user/agent/profil/view/' . $store->id) }}"
                                                    class="link">{{ $store->store_name }}</a></h6>
                                            <p class="mt-4 text-variant-1">{{ $store->agent_category }}</p>
                                        </div>
                                    </div>
                                    <ul class="list-info">
                                        <li class="item"><span
                                                class="icon icon-phone-line2"></span>{{ $store->store_contact }}</li>
                                        <li class="item"><span
                                                class="icon icon-mail-line"></span>{{ $store->store_email }}</li>
                                        <li style="height:20px;overflow:hidden;width:100%;" class="item"><span
                                                class="icon icon-mapPin"></span>{{ $store->store_adress }} </li>
                                    </ul>
                                    <a href="{{ url('/user/agent/profil/view/' . $store->id) }}"
                                        class="tf-btn btn-view style-1 primary size-1">Voir le profil <i
                                            class="icon icon-arrow-right2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
</main>
<!-- end main container -->
@endsection
