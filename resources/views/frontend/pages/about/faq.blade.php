@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | FAQ
@endsection
<!--=====================================
Breadcrumbs
======================================-->
<div>
    <ul class="breadcrumbs mb-4">
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li>A propos</li>
        </li>
        <li>Questions/Reponses</li>
    </ul>
</div>
<!-- privacy section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <!-- General question -->
                <h3 class="mb-3">Questions Generales</h3>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Q1 : Comment passer une commande ?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body text-dark">
                                Sélectionnez vos matériaux en ligne, validez votre panier, puis procédez au paiement via
                                Stripe ou un autre moyen sécurisé.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Q2 : Quels moyens de paiement acceptez-vous ?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body text-dark">
                                Nous acceptons les paiements en Euro (€), Dollar ($) et Franc CFA (FCFA).
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Q3 : Est-il possible de payer en plusieurs fois ?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body text-dark">
                                <strong>Oui, nous proposons le paiement en 3 tranches mensuelles.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Regular question -->
                <h3 class="mb-3 mt-5">Questions Regulieres</h3>
                <div class="accordion mb-4" id="accordionExample2">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOneR">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOneR" aria-expanded="true" aria-controls="collapseOneR">
                                Q4 : Comment suivre ma commande ?
                            </button>
                        </h2>
                        <div id="collapseOneR" class="accordion-collapse collapse" aria-labelledby="headingOneR"
                            data-bs-parent="#accordionExample2">
                            <div class="accordion-body text-dark">
                                Une fois votre commande validée, vous recevrez un accès à l’espace de suivi en ligne
                                pour vérifier chaque étape jusqu’à la livraison au Cameroun.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwoR">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwoR" aria-expanded="false" aria-controls="collapseTwoR">
                                Q5 : Qui contacter en cas de problème ?
                            </button>
                        </h2>
                        <div id="collapseTwoR" class="accordion-collapse collapse" aria-labelledby="headingTwoR"
                            data-bs-parent="#accordionExample2">
                            <div class="accordion-body text-dark">
                                Vous pouvez nous joindre via le formulaire de contact ou directement par e-mail. une
                                compagnie IA est également disponible pour répondre immédiatement aux questions
                                fréquentes.
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
@endsection
