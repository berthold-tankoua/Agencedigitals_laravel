@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | {{ $service->service_name_fr }}
@endsection
<!-- section begin -->
<section id="subheader" class="jarallax relative">
    <img src="{{ asset('frontend/images/background/2.webp') }}" class="jarallax-img" alt="">
    <div class="container relative z-2">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="subtitle s2 wow fadeInUp mb-2">Service</div>
                <div class="clearfix"></div>
                <h1 class="wow fadeInUp h4 mbltitle" data-wow-delay=".4s">{{ $service->service_name_fr }}</h1>
                <div class="crumb-wrapper">
                    <ul class="crumb wow fadeInUp" data-wow-delay=".8s">
                        <li><a href="{{ url('/') }}">Accueil</a></li>
                        <li class="active">Service</li>
                    </ul>
                </div>
            </div>

            <div class="w-40 abs abs-middle end-0 xs-hide">
                <img src="{{ asset('frontend/images/misc/c2.webp') }}" class="w-100 wow scaleIn" data-wow-duration="2s"
                    alt="">
            </div>
        </div>
    </div>
</section>
<!-- section close -->

<section>
    <div class="container">
        <div class="text-black">
            {!! $service->short_descp_fr !!}

        </div>
    </div>
</section>
@endsection
