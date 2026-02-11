@extends('frontend.main_master')

@section('title', 'AgenceDigitals | Details des commandes')

@section('content')
    <!-- shop cart section -->
    <div class=" my-5">
        <div class="container">
            <div class="row">
                <!-- cart section -->
                <div class="col-lg-6 col-md-12">
                    <div class="pb-3">
                        <!-- alert -->
                        <div class="alert alert-info py-2 rounded-pill mb-2" role="alert">
                            <p class="mb-0">Les champs marqués d’un <strong class="text-danger">astérisque (*)</strong> sont
                                obligatoires.</p>
                        </div>
                        <!-- checkout details -->
                        <form action="{{ route('checkout.store') }}" method="POST" class="accordion accordion-flush"
                            id="accordionFlushExample">
                            @csrf
                            <!-- delivery address -->
                            <div class="accordion-item py-4">
                                <div class=" mb-2 d-flex justify-content-between align-items-center accordion-header">
                                    <a href="#" class="fs-6 text-inherit h4">
                                        <i class="bi bi-person-bounding-box me-2 fs-4"></i>Informations
                                    </a>
                                </div>
                                @auth
                                    <section>
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <label for="name" class="ms-3">Votre nom <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control rounded-pill"
                                                    placeholder="Saisir votre Nom " value="{{ Auth::user()->name }}"
                                                    name="last_name" required="Saisir votre nom">
                                            </div>
                                            <div class="col-6">
                                                <label for="lastname" class="ms-3">Votre prenom <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control rounded-pill"
                                                    placeholder="Saisir votre Prenom" value="{{ Auth::user()->name }}"
                                                    name="first_name" required="Saisir votre prenom">
                                            </div>
                                            <div class="col-12">
                                                <label for="email" class="ms-3">Votre email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" id="email" name="email"
                                                    class="form-control rounded-pill" placeholder="Saisir votre email" required
                                                    value="{{ Auth::user()->email }}">
                                            </div>
                                            <div class="col-12">
                                                <label for="phone" class="form-label ms-3">
                                                    Numéro de contact <small>(WhatsApp de préférence)</small> <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="tel" id="phone" name="phone" required
                                                    class="form-control rounded-pill" value="{{ Auth::user()->phone }}"
                                                    placeholder="Exemple : +237 6 99 99 99 99">
                                                <input type="hidden" name="user_phone" id="user_phone"
                                                    value="{{ Auth::user()->phone }}">
                                            </div>

                                        </div>
                                    </section>
                                @else
                                    <section>
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <label for="name" class="ms-3">Votre nom <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control rounded-pill"
                                                    placeholder="Saisir votre Nom " name="first_name"
                                                    required="Saisir votre nom">
                                            </div>
                                            <div class="col-6">
                                                <label for="lastname" class="ms-3">Votre prenom <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control rounded-pill"
                                                    placeholder="Saisir votre Prenom" name="last_name"
                                                    required="Saisir votre prenom">
                                            </div>
                                            <div class="col-12">
                                                <label for="email" class="ms-3">Votre email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" id="email" name="email"
                                                    class="form-control rounded-pill" placeholder="Saisir votre email" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="phone" class="form-label ms-3">
                                                    Numéro de contact <small>(WhatsApp de préférence)</small> <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="tel" id="phone" name="phone" required
                                                    class="form-control rounded-pill"
                                                    placeholder="Exemple : +237 6 99 99 99 99">
                                                <input type="hidden" name="user_phone" id="user_phone">
                                            </div>

                                        </div>
                                    </section>
                                @endauth

                            </div>

                            <div class="accordion-item py-4">
                                <div class="mb-2 d-flex justify-content-between align-items-center accordion-header">
                                    <a href="#" class="fs-6 text-inherit h4">
                                        <i class="bi bi-geo-alt me-2 fs-4"></i>Adresse de Livraison
                                    </a>
                                </div>
                                <section>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="country" class="ms-3">Pays <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="country" class="form-control rounded-pill"
                                                name="country" placeholder="Saisir votre pays" value="Cameroun" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="town" class="ms-3">Ville <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="town" class="form-control rounded-pill"
                                                name="town" placeholder="Saisir votre ville de residence" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="quarter" class="ms-3">Quartier ou Rue <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="quarter" class="form-control rounded-pill"
                                                name="quarter" placeholder="Saisir votre quartier ou rue" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="post_code" class="ms-3">Code zip ou Code Postal</label>
                                            <input type="text" class="form-control rounded-pill" id="post_code"
                                                name="post_code" placeholder="Zip Code">
                                        </div>
                                        <div class="col-12">
                                            <label for="notes" class="form-label">Informations supplémentaires</label>
                                            <textarea class="form-control" rows="3" id="notes" name="notes"
                                                placeholder="Indiquez des détails précis sur votre adresse ou vos instructions de livraison"></textarea>
                                        </div>

                                    </div>
                                </section>

                            </div>
                            <!-- order details -->
                            <div class="accordion-item py-4">
                                <div class="d-flex justify-content-between align-items-center accordion-header"
                                    id="flush-headingFours">
                                    <a href="#" class="fs-6 text-inherit h4" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFours" aria-expanded="true"
                                        aria-controls="flush-collapseFours">
                                        <i class="bi bi-cart me-2 fs-4"></i> Details de la Commande <i
                                            class="bi bi-chevron-down"></i>
                                    </a>
                                </div>
                                <div id="flush-collapseFours" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingFours" data-bs-parent="#accordionFlushExample">
                                    <div class="mt-4">
                                        <div class="card shadow-sm">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($carts as $cart)
                                                    <li class="list-group-item px-4 py-3">
                                                        <div class="row align-items-center">
                                                            <div class="col-2 col-md-2">
                                                                <img src="{{ asset($cart->options->image) }}"
                                                                    alt="product" class="img-fluid">
                                                            </div>
                                                            <div class="col-5 col-md-5">
                                                                <a href="shop-single.html" class="text-inherit">
                                                                    <p class="mb-0 font-small">{{ $cart->name }}</p>
                                                                </a>
                                                                <span><small class="text-muted font-extra-small">Quantite:
                                                                        {{ $cart->qty }}</small></span>
                                                            </div>
                                                            <!-- input group -->
                                                            <div class="col-2 col-md-2 d-flex flex-column text-center">
                                                                <small class="text-secondary">Qte</small>
                                                                <span
                                                                    class="text-muted font-extra-small">{{ $cart->qty }}</span>
                                                            </div>
                                                            <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                                <small class="text-secondary">Prix Unitaire</small>
                                                                <span class="fw-bold small">{{ $cart->price }}
                                                                    {{ $cart->options->currency }}</span>
                                                                <div class="text-decoration-line-through text-muted small">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <!-- repetable -->
                                                <li class="list-group-item px-4 py-3">
                                                    <div
                                                        class="d-flex align-items-center justify-content-between mb-2 small">
                                                        <div>Sous Total</div>
                                                        <div class="fw-bold">{{ $cartTotal }} {{ $cartCurrency }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between mb-2 small">
                                                        <div>Quantite Total</div>
                                                        <div class="fw-bold">{{ $cartQty }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between small">
                                                        <div>Frais de Transit <i class="bi bi-info-circle text-muted"
                                                                data-bs-toggle="tooltip" data-bs-title="GST Details"></i>
                                                        </div>
                                                        <div class="fw-bold">{{ $transitFee }} {{ $cartCurrency }}
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- repetable -->
                                                <li class="list-group-item px-4 py-3">
                                                    <div class="d-flex align-items-center justify-content-between fw-bold">
                                                        <div>Total</div>
                                                        <div>{{ $totalPrice }} {{ $cartCurrency }}</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- payment method -->
                            <div class="accordion-item py-4">
                                <div class="d-flex justify-content-between align-items-center accordion-header"
                                    id="flush-headingThree">
                                    <a href="#" class="fs-6 text-inherit h4 align-items-center"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                        aria-expanded="true" aria-controls="flush-collapseThree">
                                        <i class="bi bi-credit-card me-2 fs-4"></i> Methode de Paiement <i
                                            class="bi bi-chevron-down"></i>
                                    </a>
                                </div>
                                <div class="" aria-labelledby="flush-headingThree"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="mt-3">
                                        <div>
                                            <div class="card shadow-sm border-0 my-3">
                                                <div class="card-body d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">
                                                        <i class="bi bi-wallet2 text-primary me-2"></i>
                                                        <span class="fw-bold">Total :</span>
                                                    </h5>
                                                    <h4 class="mb-0 text-success fw-bold">
                                                        {{ number_format($totalPrice, 1, ',', ' ') }} {{ $cartCurrency }}
                                                    </h4>
                                                    <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                                                    <input type="hidden" name="cartCurrency"
                                                        value="{{ $cartCurrency }}">
                                                </div>
                                            </div>
                                            <div class="card card-bordered shadow-none mb-2">
                                                <!-- card body -->
                                                <div class="card-body p-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-check">
                                                            <!-- radio -->
                                                            <input class="form-check-input" type="radio" checked
                                                                name="payment_method" id="stripe" value="stripe">
                                                            <label class="form-check-label ms-2" for="stripe">
                                                                Payer avec Stripe
                                                            </label>
                                                        </div>
                                                        <div class="ms-3">
                                                            <img src="{{ asset('frontend/img/stripe.png') }}"
                                                                alt="Stripe" style="max-width: 180px; height: auto;">
                                                        </div>
                                                    </div>
                                                    <p class="text-secondary mt-2 d-flex align-items-center">
                                                        <i class="bi bi-credit-card-2-back me-2"></i>
                                                        Paiement flexible : possibilité de régler en plusieurs mensualités.
                                                    </p>

                                                </div>
                                            </div>

                                            <!-- card -->
                                            {{-- <div class="card card-bordered shadow-none mb-2">
                                                <div class="card-body p-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-check">
                                                            <!-- radio -->
                                                            <input class="form-check-input" type="radio"
                                                                name="payment_method" id="notchpay" value="notchpay">
                                                            <label class="form-check-label ms-2" for="notchpay">
                                                                Payer avec CinetPay
                                                            </label>
                                                        </div>
                                                        <div class="ms-3">
                                                            <img src="{{ asset('frontend/img/cinetpay.jpg') }}" alt="CinetPay"
                                                                style="max-width: 180px; height: auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="mt-5 d-flex justify-content-end custom-button">
                                                <button
                                                    class="rounded-pill custom-btn-primary font-small button-effect px-4 ms-2">PASSER
                                                    LA COMMANDE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- checkout box -->
                <div class="col-12 col-md-12 offset-lg-1 col-lg-5">
                    <div class="mt-4 mt-lg-0">
                        <div class="card shadow-sm">
                            <h5 class="px-3 py-4 bg-transparent mb-0">Mon Panier</h5>
                            <ul class="list-group list-group-flush">
                                @foreach ($carts as $cart)
                                    <li class="list-group-item px-4 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-2 col-md-2">
                                                <img src="{{ asset($cart->options->image) }}" alt="product"
                                                    class="img-fluid">
                                            </div>
                                            <div class="col-5 col-md-5">
                                                <a href="shop-single.html" class="text-inherit">
                                                    <p class="mb-0 font-small">{{ $cart->name }}</p>
                                                </a>
                                                <span><small class="text-muted font-extra-small">Quantite:
                                                        {{ $cart->qty }}</small></span>
                                            </div>
                                            <!-- input group -->
                                            <div class="col-2 col-md-2 d-flex flex-column text-center">
                                                <small class="text-secondary">Qte</small>
                                                <span class="text-muted font-extra-small">{{ $cart->qty }}</span>
                                            </div>
                                            <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                <small class="text-secondary">Prix Unitaire</small>
                                                <span class="fw-bold small">{{ $cart->price }}
                                                    {{ $cart->options->currency }}</span>
                                                <div class="text-decoration-line-through text-muted small"></div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                <!-- repetable -->
                                <li class="list-group-item px-4 py-3">
                                    <div class="d-flex align-items-center justify-content-between mb-2 small">
                                        <div>Sous Total</div>
                                        <div class="fw-bold">{{ $cartTotal }} {{ $cartCurrency }}</div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2 small">
                                        <div>Quantite Total</div>
                                        <div class="fw-bold">{{ $cartQty }}</div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between small">
                                        <div>Frais de Transit <i class="bi bi-info-circle text-muted"
                                                data-bs-toggle="tooltip" data-bs-title="GST Details"></i>
                                        </div>
                                        <div class="fw-bold">{{ $transitFee }} {{ $cartCurrency }}</div>
                                    </div>
                                </li>
                                <!-- repetable -->
                                <li class="list-group-item px-4 py-3">
                                    <div class="d-flex align-items-center justify-content-between fw-bold">
                                        <div>Total</div>
                                        <div>{{ $totalPrice }} {{ $cartCurrency }}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
