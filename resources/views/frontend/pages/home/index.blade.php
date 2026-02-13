@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Acceuil
@endsection
<main>
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">

        <div id="top"></div>

        <section class="relative jarallax overflow-hidden mt-5">
            <img src="{{ asset('frontend/images/background/1.webp') }}" class="jarallax-img" alt="">
            <div class="container relative z-2">
                <div class="row g-4 align-items-center relative">
                    <div class="spacer-single sm-hide"></div>
                    <div class="col-lg-6">
                        <h1 class="wow fadeInUp text-dark" data-wow-delay=".2s">AGENCEDIGITALS</h1>

                        <p class="wow fadeInUp h3 mb-4" data-wow-delay=".2s" style="font-weight: 700;">
                            Votre partenaire digital pour faire grandir votre activité
                        </p>

                        <p class="lead wow fadeInUp text-dark" data-wow-delay=".4s">
                            Je vous accompagne dans la mise en place de solutions digitales concrètes :
                            création de sites web modernes, modernisation de sites existants,
                            assistants intelligents, automatisation, amélioration de votre présence en ligne
                            et vente de produits digitaux. <br><br>
                            Gagnez du temps, automatisez vos tâches et transformez votre présence en ligne en une
                            véritable source de revenus.
                        </p>

                        <a class="btn-main mt-3 wow fadeInUp mb-3" style="font-size:20px" data-wow-delay=".6s"
                            href="request.html">
                            Demander mon audit gratuit
                        </a>
                        <br>
                        <div class="d-flex  relative mt-2 w-100">
                            <div>
                                <h3 class="fs-48 id-color mb-0 ">100+</h3>
                                <p class="fs-20">Projets</p>
                            </div>

                            <div class="ms-4">
                                <h3 class="fs-48 id-color mb-0">5+</h3>
                                <p class="fs-20">Ans D'experience</p>
                            </div>

                            <img src="{{ asset('frontend/images/misc/arrow-black.webp') }}"
                                class="absolute w-40 end-0 top-0 sm-hide anim-left-right m-4" alt="">
                        </div>
                    </div>

                    <div class="col-lg-6 banner-img">
                        <img src="{{ asset('frontend/images/misc/c1.webp') }}" class="w-100" alt=""
                            data-0="transform: translateY(0px);" data-800="transform: translateY(-500px);">

                        <div class="position-relative">
                            <div class="bg-white shadow-soft abs abs-middle end-4 mt-1 p-4 py-3 rounded-1 overflow-hidden z-2 wow fadeInLeft"
                                data-wow-delay=".7s">
                                <div class="d-flex justify-content-center">
                                    <div class="relative me-4">
                                        <img src="{{ asset('frontend/images/testimonial/1.webp') }}"
                                            class="w-50px circle ms-min-10" alt="">
                                        <img src="{{ asset('frontend/images/testimonial/2.webp') }}"
                                            class="w-50px circle ms-min-10" alt="">
                                        <img src="{{ asset('frontend/images/testimonial/3.webp') }}"
                                            class="w-50px circle ms-min-10" alt="">
                                    </div>
                                    <div class="fw-600 fs-14 lh-1-5"><span
                                            class="fs-18 fw-bold text-dark">+50</span><br>Clients satisfaits</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="spacer-single"></div>

            </div>

        </section>
        <br>
        <section class="section-dark p-0" aria-label="section" style="z-index: 1000 !important">
            <div class="bg-color text-light d-flex py-4 lh-1 rot-2 mt-min-40">
                <div class="de-marquee-list-1">
                    @foreach ($services as $service)
                        <a href="{{ url('service/details/' . $service->id . '/' . $service->service_slug_fr) }}"
                            class="fs-30 mx-3">{{ $service->service_name_fr }}</a>
                        <a href="/" class="fs-40 mx-3 op-3">/</a>
                    @endforeach
                </div>
            </div>


        </section>

        <section>
            <div class="container">

                <div class="owl-carousel owl-3-dots">
                    <!-- Existing 3 items -->
                    <div class="item">
                        <div class="bg-color-op-2 relative h-100 p-20 rounded-1">
                            <img src="{{ asset('frontend/images/icons/white/search.png') }}"
                                class="w-90px bg-color text-light p-3 rounded-10px fs-56 mb-4" alt="">
                            <h3>Analyse de vos besoins</h3>
                            <p>Nous échangeons sur votre activité, vos objectifs et vos contraintes afin d’identifier
                                les solutions adaptées. Cette étape permet de
                                poser une base claire avant toute mise en place.
                            </p>
                            <a class="btn-plus" href="{{ url('service/details/2/analyse-de-vos-besoins') }}">
                                <i class="fa fa-plus"></i>
                                <span>Discuter avec nous</span>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg-color-2-op-2 relative h-100 p-20 rounded-1">
                            <img src="{{ asset('frontend/images/icons/white/coding.png') }}"
                                class="w-90px bg-color-2 text-light p-3 rounded-10px fs-56 mb-4" alt="">
                            <h3>Conception de site web </h3>
                            <p>
                                Je conçois un site web moderne, clair et aligné avec vos objectifs afin de renforcer
                                votre présence en ligne, valoriser votre activité et offrir une expérience fluide à vos
                                visiteurs.
                            </p>
                            <a class="btn-plus" href="{{ url('service/details/1/conception-de-site-web') }}">
                                <i class="fa fa-plus"></i>
                                <span>En savoir plus</span>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg-color-3-op-2 relative h-100 p-20 rounded-1">
                            <img src="{{ asset('frontend/images/icons/white/content.png') }}"
                                class="w-90px bg-color-3 text-light p-3 rounded-10px fs-56 mb-4" alt="">
                            <h3>Vente des formations </h3>
                            <p>
                                Formations en programmation, infographie, DevOps et autres, conçues pour
                                apprendre, progresser à votre rythme et acquérir des compétences concrètes.
                            </p>
                            <a class="btn-plus" href="{{ url('service/details/3/vente-des-formations') }}">
                                <i class="fa fa-plus"></i>
                                <span>Consulter nos produits</span>
                            </a>
                        </div>
                    </div>

                    <!-- New 3 items -->
                    <div class="item">
                        <div class="bg-color-op-2 relative h-100 p-20 rounded-1">
                            <img src="{{ asset('frontend/images/icons/white/startup.png') }}"
                                class="w-90px bg-color text-light p-3 rounded-10px fs-56 mb-4" alt="">
                            <h3>SEO technique</h3>
                            <p>
                                Améliorez les performances de votre site WEB en optimisant la vitesse,
                                l’adaptation mobile, l’exploration, l’indexation
                                afin d’obtenir de meilleurs résultats.
                            </p>

                            <a class="btn-plus" href="{{ url('service/details/4/seo-technique') }}">
                                <i class="fa fa-plus"></i>
                                <span>En savoir plus</span>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg-color-2-op-2 relative h-100 p-20 rounded-1">
                            <img src="{{ asset('frontend/images/icons/white/placeholder.png') }}"
                                class="w-90px bg-color-2 text-light p-3 rounded-10px fs-56 mb-4" alt="">
                            <h3>Conception d'agents IA</h3>
                            <p>
                                Mise en place d’assistants intelligents capables d’automatiser certaines
                                tâches(mail,rendez-vous,etc.) et de vous faire gagner du temps et booster l’efficacité
                                de votre activité .
                            </p>
                            <a class="btn-plus" href="{{ url('service/details/5/conception-dagents-ia') }}">
                                <i class="fa fa-plus"></i>
                                <span>En savoir plus</span>
                            </a>
                        </div>
                    </div>

                </div>


            </div>
        </section>
        <section>
            <div class="container">
                <div class="row g-4 gx-5">
                    <div class="col-lg-4">
                        <div class="subtitle id-color wow fadeInUp mb-3">Pourquoi nous choisir.?</div>
                        <h2 class="wow fadeInUp">Boost Your Online Visibility</h2>
                        <div class="relative">
                            <a href="request.html" class="btn-main fx-slide btn-light-trans"><span>Obtener un audit
                                    gratuit</span></a>
                            <img src="{{ asset('frontend/images/misc/arrow-black.webp') }}"
                                class="absolute w-50 end-0 top-0 sm-hide anim-left-right" alt="">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <h4 class="mb-4 wow fadeInRight">Pourquoi me choisir</h4>
                        <ol class="ol-style-1">
                            <li class="wow fadeInUp" data-wow-delay=".2s">
                                Une expertise digitale globale pour mettre en place des solutions adaptées à votre
                                activité.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".4s">
                                Des outils professionnels pour analyser, optimiser et améliorer vos performances en
                                ligne.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".6s">
                                Un accompagnement personnalisé pour structurer et faire évoluer votre présence digitale.
                            </li>
                        </ol>
                    </div>

                    <div class="col-lg-4">
                        <h4 class="mb-4 wow fadeInRight">Les bénéfices pour vous</h4>
                        <ol class="ol-style-1">
                            <li class="wow fadeInUp" data-wow-delay=".2s">
                                Une meilleure visibilité en ligne auprès de votre audience cible.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".4s">
                                Plus d’engagement, une expérience utilisateur améliorée et des visiteurs plus qualifiés.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".6s">
                                Une image de marque renforcée et une crédibilité accrue auprès de vos clients.
                            </li>
                        </ol>
                    </div>
                    <div class="spacer-half"></div>
                </div>
            </div>
        </section>

        <section style="margin-top: -90px !important;">
            <div class="container">
                <div class="row g-4 mb-2 justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="subtitle s2 mb-3 wow fadeInUp" data-wow-delay=".0s">Prix</div>
                        <h2 class="wow fadeInUp h3" data-wow-delay=".2s">Decouvrez nos differents prix</h2>
                        <p class="mt-2 wow fadeInUp" data-wow-delay=".3s">Choisissez la solution qui correspond à
                            vos objectifs,
                            que vous débutiez ou que vous souhaitiez développer et structurer votre présence digitale.
                        </p>
                    </div>
                </div>

                <div class="row g-4">

                    <!-- Diagnostic Gratuit -->
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".2s">
                        <div class="bg-color text-light text-center p-30 rounded-1">
                            <h3>Diagnostic gratuit</h3>
                            <div class="spacer-single"></div>
                            <img src="{{ asset('frontend/images/icons/search.png') }}" class="w-70px"
                                alt="Diagnostic Digital Gratuit">
                            <div class="spacer-single"></div>
                            <h3 class="mb-2">GRATUIT</h3>
                            <p class="text-white">Analyse de votre situation digitale ou de vos besoins.</p>
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

                    <!-- Conception site web -->
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".4s">
                        <div class="bg-color-2 text-light text-center p-30 rounded-1">
                            <h3>Conception de site web</h3>
                            <div class="spacer-single"></div>
                            <img src="{{ asset('frontend/images/icons/chart.png') }}" class="w-70px"
                                alt="Solutions Web">
                            <div class="spacer-single"></div>
                            <h3 class="mb-2">À partir de 350 $</h3>
                            <p class="text-white">Idéal pour renforcer votre présence en ligne.</p>
                            <a class="btn-main fx-slide btn-dark-trans w-100 mb-4" href="#">
                                <span>Lancer le projet</span>
                            </a>
                            <div class="text-start">
                                <ul class="ul-check white">
                                    <li>Création de site web moderne</li>
                                    <li>Modernisation de site existant</li>
                                    <li>Design clair et orienté utilisateur</li>
                                    <li>Optimisation des performances</li>
                                    <li>Structure pensée pour la visibilité</li>
                                    <li>Accompagnement personnalisé</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Agents IA & Automatisation -->
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".6s">
                        <div class="bg-color-3 text-light text-center p-30 rounded-1">
                            <h3 class="h4">Agents IA & automatisation</h3>
                            <div class="spacer-single"></div>
                            <img src="{{ asset('frontend/images/icons/startup.png') }}" class="w-70px"
                                alt="Agents IA et Automatisation">
                            <div class="spacer-single"></div>
                            <h3 class="mb-2">À partir de 50 $</h3>
                            <p class="text-white">Des outils intelligents qui travaillent pour vous.</p>
                            <a class="btn-main fx-slide btn-dark-trans w-100 mb-4" href="#">
                                <span>Démarrer</span>
                            </a>
                            <div class="text-start">
                                <ul class="ul-check white">
                                    <li>Mise en place d’assistants intelligents</li>
                                    <li>Automatisation de tâches répétitives</li>
                                    <li>Amélioration de la relation client</li>
                                    <li>Outils adaptés à votre activité</li>
                                    <li>Gain de temps au quotidien</li>
                                    <li>Solutions évolutives</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section class="bg-color-op-1 rounded-1 mx-4">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <div class="subtitle wow fadeInUp">Vous vous posez des questions ?</div>
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">Nous avons les réponses</h2>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="btn-text text-dark wow fadeInLeft" href="#">Voir toutes les questions</a>
                    </div>
                </div>

                <div class="row g-custom-4">
                    <div class="col-lg-6 wow fadeInUp">
                        <div class="accordion secondary">
                            <div class="accordion-section">
                                <div class="accordion-section-title" data-tab="#accordion-1">
                                    Qu’est-ce que le SEO et pourquoi est-ce important ?
                                </div>
                                <div class="accordion-section-content" id="accordion-1">
                                    <p>
                                        Le SEO (référencement naturel) consiste à optimiser votre présence en ligne
                                        pour attirer plus de visiteurs qualifiés sur votre site web. Il permet
                                        d’améliorer
                                        la visibilité, d’attirer des clients potentiels et de renforcer la crédibilité
                                        de votre activité sur Internet.
                                    </p>
                                </div>

                                <div class="accordion-section-title" data-tab="#accordion-2">
                                    Combien de temps pour voir les résultats ?
                                </div>
                                <div class="accordion-section-content" id="accordion-2">
                                    <p>
                                        Les résultats dépendent de votre secteur, de votre site et des actions mises en
                                        place.
                                        En général, des améliorations visibles peuvent apparaître après quelques mois,
                                        mais le digital est un processus continu qui demande patience et constance.
                                    </p>
                                </div>

                                <div class="accordion-section-title" data-tab="#accordion-3">
                                    Quels services digitaux proposez-vous ?
                                </div>
                                <div class="accordion-section-content" id="accordion-3">
                                    <p>
                                        Nous proposons un accompagnement complet : audit et analyse de votre activité,
                                        optimisation de votre site, création de contenu, automatisation, mise en place
                                        d’outils intelligents, développement de votre présence en ligne et suivi
                                        régulier
                                        pour assurer des résultats concrets.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 wow fadeInUp">
                        <div class="accordion secondary">
                            <div class="accordion-section">
                                <div class="accordion-section-title" data-tab="#accordion-b-4">
                                    Pouvez-vous garantir les résultats ?
                                </div>
                                <div class="accordion-section-content" id="accordion-b-4">
                                    <p>
                                        Nous ne garantissons pas de position précise sur les moteurs de recherche,
                                        mais nous nous engageons à mettre en place des stratégies digitales efficaces,
                                        éthiques et adaptées à vos objectifs pour améliorer votre visibilité et vos
                                        performances.
                                    </p>
                                </div>

                                <div class="accordion-section-title" data-tab="#accordion-b-5">
                                    Comment choisissez-vous la meilleure stratégie pour mon activité ?
                                </div>
                                <div class="accordion-section-content" id="accordion-b-5">
                                    <p>
                                        Nous commençons par analyser votre activité, vos objectifs et votre audience.
                                        Ensuite, nous définissons une stratégie digitale sur mesure, adaptée à vos
                                        besoins,
                                        vos ressources et vos priorités.
                                    </p>
                                </div>

                                <div class="accordion-section-title" data-tab="#accordion-b-6">
                                    Quel type de suivi puis-je attendre ?
                                </div>
                                <div class="accordion-section-content" id="accordion-b-6">
                                    <p>
                                        Nous fournissons un suivi clair et transparent : performances du site, trafic,
                                        impact des outils et résultats des actions mises en place. Nous restons
                                        disponibles
                                        pour toute explication ou ajustement.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-7">
                        <div class="text-center">
                            <div class="subtitle">Consultation gratuite</div>
                            <h3 class="wow fadeInUp h3">Contactez-moi dès aujourd'hui</h3>
                            <p class="col-12">
                                Une question, une suggestion ou juste envie de discuter ?
                                Je suis là pour vous écouter et vous accompagner !
                            </p>
                        </div>
                    </div>
                </div>

                @include('frontend.components.contact')
            </div>
        </section>


        <section class="bg-color-3-op-1 relative overflow-hidden rounded-1 mx-4 mb-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-8">
                        <div class="owl-carousel owl-single-dots">
                            <div class="ps-lg-5 ps-0">
                                <i class="icofont-quote-left id-color-2 fs-40 mb-4 wow fadeInUp"></i>
                                <h3 class="fs-28 mb-4 wow fadeInUp">
                                    Résultats exceptionnels ! Le trafic de notre site a considérablement augmenté depuis
                                    notre collaboration avec AgenceDigitals. Leurs solutions digitales apportent une
                                    réelle valeur et visibilité. Hautement recommandé !
                                </h3>
                                <span class="wow fadeInUp">Mr Gides, Agent Immobilier</span>
                            </div>

                            <div class="pe-lg-5 pe-0">
                                <i class="icofont-quote-left id-color-2 fs-40 mb-4 wow fadeInUp"></i>
                                <h3 class="fs-28 mb-4 wow fadeInUp">
                                    Performance impressionnante ! Nous avons observé une croissance notable de notre
                                    présence en ligne grâce aux services d'AgenceDigitals. Leur accompagnement
                                    stratégique et leur professionnalisme dépassent nos attentes.
                                </h3>
                                <span class="wow fadeInUp">Crostel Foppa, Entrepreneur</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="relative text-center">
                            <div class="d-inline-block text-center m-4 wow fadeInRight" data-wow-delay=".2s">
                                <h4 class="fw-bold mb-1 fs-24">Excellent</h4>
                                <div class="de-rating-ext fs-18">
                                    <span class="d-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <div class="fs-14 mb-0">Basé sur <span class="fw-bold">50 avis</span></div>
                                    <img src="{{ asset('frontend/images/misc/trustpilot-invert.webp') }}"
                                        class="w-100px" alt="">
                                </div>
                            </div>

                            <div class="d-inline-block text-center m-4 wow fadeInRight" data-wow-delay=".4s">
                                <h4 class="fw-bold mb-1 fs-24">4,8 sur 5</h4>
                                <div class="de-rating-ext fs-18">
                                    <span class="d-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <div class="fs-14 mb-0">Basé sur <span class="fw-bold">20 avis</span></div>
                                    <img src="{{ asset('frontend/images/misc/google.webp') }}" class="w-100px"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- content close -->
</main>
@endsection
