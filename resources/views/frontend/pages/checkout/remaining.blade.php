@extends('frontend.main_master')

@section('title', 'AgenceDigitals | Details des commandes')

@section('content')
    <!-- shop cart section -->
    <div class=" my-3">
        <div class="container">
            <div class="row justify-content-center">
                <!-- cart section -->
                <div class="col-lg-6 col-md-12">
                    <div class="pb-3">

                        <!-- checkout details -->
                        <form action="{{ route('stripe.paid.remaining.order') }}" method="POST"
                            class="accordion accordion-flush" id="accordionFlushExample">
                            @csrf
                            <input type="hidden" name="orderId" value="{{ $order->id }}">
                            <!-- payment method -->
                            <div class="accordion-item py-4">
                                <div class="d-flex justify-content-between align-items-center accordion-header"
                                    id="flush-headingThree">
                                    <a href="#" class="fs-6 text-inherit h4 align-items-center"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="true"
                                        aria-controls="flush-collapseThree">
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
                                                        {{ $order->remaining_amount }} {{ $order->currency }}
                                                    </h4>
                                                    <input type="hidden" name="totalPrice"
                                                        value="{{ $order->remaining_amount }}">
                                                    <input type="hidden" name="currency" value="{{ $order->currency }}">
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
                                                            <img src="{{ asset('frontend/img/stripe.png') }}" alt="Stripe"
                                                                style="max-width: 180px; height: auto;">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- card -->
                                            {{-- <div class="card card-bordered shadow-none mb-2">
                                                <div class="card-body p-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-check">

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

            </div>
        </div>
    </div>
@endsection
