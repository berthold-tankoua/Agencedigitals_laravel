@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Nos services
@endsection
<!-- All Services section -->
<section class="product-sec py-5 overflow-hidden">
    <div class="container">
        <div class="row my-5">
            <div class="col-12 animate__animated wow animate__backInUp">
                <h2 class="fs-1 text-center theme-text-primary mb-3">Nos Services</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($services as $service)
                <div class="col-12 col-md-4 mb-3 animate__animated wow animate__fadeInLeft animate__delay-2s">
                    <a href="{{ url('service/details/' . $service->id . '/' . $service->service_slug_fr) }}" class="box set-bg"
                        data-setbg="{{ asset($service->service_thambnail) }}">
                        <div class="content">
                            <p class="theme-heading theme-text-white mb-0 theme-text-shadow text-center">
                                {{ $service->service_name_fr }}</p>
                        </div>
                        <div class="content-hover">
                            <h3 class="theme-text-white text-center">{{ $service->service_name_fr }}</h3>
                            <p>Cliquer pour en savoir plus</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- call to action type2  -->
<div class="mt-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center cta rounded-pill overflow-hidden flex-column">
                <h6 class="fs-2 fw-bold theme-text-white">Know more about?</h6>
                <p class="fs-6 theme-text-white small px-5 my-4">To Make Requests For The Further Information</p>
                <div class="custom-button mt-3">
                    <a href="#"
                        class="rounded-pill btn custom-btn-secondary button-effect px-3 theme-bg-primary border border-white">
                        <i class="bi bi-arrow-right-circle-fill me-4 fs-4"></i>
                        Contact Us Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
