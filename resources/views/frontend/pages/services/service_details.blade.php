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
        <div class="row">
            <div class="col-md-8">
                <div class="text-black">
                    {!! $service->short_descp_fr !!}

                </div>
            </div>
            <div class="col-md-4">
                <!-- Diagnostic Gratuit -->
                <div class="wow fadeInRight" data-wow-delay=".2s">
                    <div class="bg-color text-light text-center p-30 rounded-1">

                        <div class="spacer-single"></div>
                        <img src="{{ asset('frontend/images/icons/search.png') }}" class="w-70px"
                            alt="Diagnostic Digital Gratuit">
                        <div class="spacer-single"></div>
                        <h3 class="mb-2">DEVIS GRATUIT</h3>
                        <p class="text-white">Analyse gratuite de votre situation ou de vos besoins.</p>
                        <a class="btn-main fx-slide btn-dark-trans w-100 mb-4" href="#">
                            <span>Commencer</span>
                        </a>
                        <div class="text-start">
                            <ul class="ul-check white">
                                <li>Analyse de vos besoins</li>
                                <li>Évaluation de votre présence en ligne</li>
                                <li>Identification des opportunités d’amélioration</li>
                                <li>Analyse d’un site ou projet</li>
                                <li>Échange par email ou message</li>
                                <li>Recommandations de base</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<div class="container">
    <div class="row text-center justify-content-center">
        <div class="col-lg-9">
            <h3 class="wow fadeInUp">Prêt à transformer vos idées en résultats ?</h3>
            <p class="wow fadeInUp">
                Confiez-nous votre projet et bénéficiez d’une stratégie sur mesure
                pour développer votre visibilité, automatiser vos processus et augmenter vos performances.
            </p>
        </div>
    </div>
    @include('frontend.components.contact')

</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="mb-4 wow fadeInUp">Processus de travail</h3>

                <div class="row justify-content-center">

                    <!-- Étape 1 -->
                    <div class="col-6 col-md-3 de-step de-step-arrow wow fadeInRight" data-wow-delay=".2s">
                        <div class="de-step-icon">
                            <i class="fas fa-search fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Étape 1</h4>
                        <p>
                            Analyse rapide de vos besoins, de votre marché et de vos objectifs.
                        </p>
                    </div>

                    <!-- Étape 2 -->
                    <div class="col-6 col-md-3 de-step de-step-arrow wow fadeInRight" data-wow-delay=".4s">
                        <div class="de-step-icon">
                            <i class="fas fa-sitemap fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Étape 2</h4>
                        <p>
                            Élaboration d’une stratégie claire et d’un plan d’action structuré.
                        </p>
                    </div>

                    <!-- Étape 3 -->
                    <div class="col-6 col-md-3 de-step de-step-arrow wow fadeInRight" data-wow-delay=".6s">
                        <div class="de-step-icon">
                            <i class="fas fa-pen-nib fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Étape 3</h4>
                        <p>
                            Mise en œuvre de la solution avec qualité et efficacité.
                        </p>
                    </div>

                    <!-- Étape 4 -->
                    <div class="col-6 col-md-3 de-step wow fadeInRight" data-wow-delay=".8s">
                        <div class="de-step-icon">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Étape 4</h4>
                        <p>
                            Suivi des performances et optimisation continue.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<br>


@endsection
