@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Messagerie
@endsection

<!-- start main container -->

<section class="ps-vendor-dashboard"><br>
    <!-- Preloader Start -->
    <div class="text-primary text-underline " style="margin-left: 25px;">
        <a href="{{ url()->previous() }}" class="m body-1 text-primary text-underline"><i
                class="fas fa-chevron-circle-left"></i> Revenir en Arriere</a>
    </div>
    <div class="container py-3 p-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="app">
                    <chat-detail :userid="{{ $userId }}"></chat-detail>
                </div>
            </div>
            <div class="col-md-4">
                <div class="container">
                    <div class="card mb-4">
                        <div class="card-body about-company">
                            <h5>Comment passer commande.?</h5>
                            <ul class="about-list">
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-bag"
                                        style="font-size: 20px"></i>1.Choisir votre produit</li>
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-cart-plus"
                                        style="font-size: 20px"></i>2.Ajouter le produit au panier d'achat</li>
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-check-circle"
                                        style="font-size: 20px"></i>3.Valider votre commande</li>
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-stripe"
                                        style="font-size: 20px"></i>4.Choisir le mode de paiement</li>
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-credit-card"
                                        style="font-size: 20px"></i>5.Effectuer le paiement</li>
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-list-check"
                                        style="font-size: 20px"></i>6.Suivi de votre commande en temps réel </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body about-company">
                            <h5>Pourquoi nous choisir.?</h5>
                            <ul class="about-list">
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-lock"
                                        style="font-size: 20px"></i>Navigation 100% sécurisée.</li>
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-check-circle"
                                        style="font-size: 20px"></i>Partenariats transparents.</li>
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-telephone"
                                        style="font-size: 20px"></i> Réactivité : Disponible 24h/24 et 7j/7.</li>
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-stripe"
                                        style="font-size: 20px"></i>Moyen de paiment fiable & securise.</li>
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-credit-card"
                                        style="font-size: 20px"></i>Flexibilité : Option de paiement en plusieurs fois.
                                </li>
                                <li class="d-flex align-items-center"><i class="me-2 bi bi-bag-check"
                                        style="font-size: 20px"></i>Suivi des commandes en temps réel .</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- end main container -->
@endsection
