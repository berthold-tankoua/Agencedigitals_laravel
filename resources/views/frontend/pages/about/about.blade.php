@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | A propos
@endsection
<!-- content begin -->
<div class="no-bottom no-top" id="content">

    <div id="top"></div>
    <!-- section begin -->
    <section id="subheader" class="jarallax relative">
        <img src="{{ asset('frontend/images/background/2.webp') }}" class="jarallax-img" alt="">
        <div class="container relative z-2">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="subtitle s2 wow fadeInUp mb-2"> </div>
                    <div class="clearfix"></div>
                    <h1 class="wow fadeInUp" data-wow-delay=".4s">A Propos</h1>
                    <div class="crumb-wrapper">
                        <ul class="crumb wow fadeInUp" data-wow-delay=".8s">
                            <li><a href="/">Accueil</a></li>
                            <li class="active">A Propos</li>
                        </ul>
                    </div>
                </div>

                <div class="w-40 abs abs-middle end-0 xs-hide">
                    <img src="{{ asset('frontend/images/misc/c5.webp') }}" class="w-100 wow scaleIn"
                        data-wow-duration="2s" alt="">
                </div>

            </div>
        </div>
    </section>
    <!-- section close -->

    <div class="relative overflow-hidden mb-2">
        <div class="container relative z-1000">
            <div class="row py-2 g-4 gx-5 justify-content-between align-items-center">

                <div class="col-lg-6">
                    <div class="relative rounded-1 overflow-hidden mb-3 wow scaleIn">
                        <img src="{{ asset('frontend/images/misc/c6.webp') }}" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="subtitle wow fadeInUp">A Propos</div>
                    <h2 class="mb-0 wow fadeInUp">Qui sommes-nous ?</h2>

                    <div class="spacer-single"></div>

                    <div class="row g-4">
                        <div class="card col-lg-12 wow fadeInUp p-4" data-wow-delay=".2s">
                            {!! $about->desc1 !!}
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>

    <div>
        <div class="container">
            <!-- Section Heading -->
            <div class="row text-dark">
                <div class="col-md-12 bg-color-2-op-2 overflow-hidden rounded-1 mb-4 p-4">
                    {!! $about->desc2 !!}
                </div>
                <div class="col-md-12 bg-color-2-op-1 overflow-hidden rounded-1 p-4">
                    {!! $about->desc3 !!}
                </div>
            </div>


        </div>
    </div>


    <section>
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-12">
                    <div class="text-center">
                        <div class="subtitle">Consultation gratuite</div>
                        <h2 class="wow fadeInUp">Contactez-nous dès aujourd'hui</h2>
                        <p class="lead col-lg-10 offset-lg-1">Vous avez une question, une suggestion ou besoin d'un
                            devis ?
                            Nous sommes là et heureux de vous entendre !</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h3 class="wow fadeInUp">Nous sommes là pour répondre à vos questions.</h3>
                    <p>Vous avez une question ou besoin d'un accompagnement ? <br>
                        Remplissez le formulaire ci-dessous et nous vous répondrons bientôt.</p>
                    <div class="spacer-single"></div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="relative mb-4">
                                <i class="abs fs-28 p-3 bg-color-2 text-light rounded-1 icofont-location-pin"></i>
                                <div class="ms-80px">
                                    <h4 class="mb-0">Localisation</h4>
                                    Ajax, Ontario, Canada
                                </div>
                            </div>

                            <div class="relative mb-4">
                                <i class="abs fs-28 p-3 bg-color-2 text-light rounded-1 icofont-envelope"></i>
                                <div class="ms-80px">
                                    <h4 class="mb-0">Envoyer un message</h4>
                                    contact@agencedigitals.com
                                </div>
                            </div>

                            <div class="relative mb-4">
                                <i class="abs fs-28 p-3 bg-color-2 text-light rounded-1 icofont-phone"></i>
                                <div class="ms-80px">
                                    <h4 class="mb-0">Passer un appel téléphonique</h4>
                                    +1 (942) 388-8634
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-6">
                    <div class=" card bg-light rounded-1 p-40 relative">
                        <form name="contactForm" id="contact_form" method="post"
                            action="{{ route('add.contact.store') }}">
                            @csrf
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <h3>Entrer en contact</h3>

                                    <div class="field-set mb-3">
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Votre Nom" required>
                                    </div>

                                    <div class="field-set mb-3">
                                        <input type="text" name="email" id="email" class="form-control"
                                            placeholder="Votre Email" required>
                                    </div>

                                    <div class="field-set mb-3">
                                        <input type="tel" name="phone" id="phone" class="form-control"
                                            placeholder="Votre Téléphone" required>
                                    </div>
                                    <div class="field-set mb-3">
                                        <input type="text" name="subject" id="subject" class="form-control"
                                            placeholder="objet de votre message" required>
                                    </div>

                                    <div class="field-set mb-3">
                                        <textarea name="message" id="message" class="form-control h-100px" placeholder="Votre Message" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div id='submit' class="mt-3">
                                <input type='submit' id='send_message' value='Envoyer le message' class="btn-main">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- content close -->

@endsection
