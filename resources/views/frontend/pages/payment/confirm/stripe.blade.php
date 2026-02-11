@extends('frontend.main_master')

@section('title')
    AgenceDigitals | Confirmer la transaction
@endsection

@section('content')
    <!--=====================================
    Checkout Stripe
    ======================================-->
    <br><br>
    <div class="ps-checkout ps-section--shopping">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-body p-4 text-center">
                            <!-- Formulaire -->
                            <form action="{{ route('stripe.checkout') }}" method="post" class="mt-4">
                                @csrf

                                <!-- Titre -->
                                <h4 class="mb-3" style="font-weight: bold; color: #333;">
                                    💳 Paiement sécurisé via Stripe
                                </h4>
                                <p class="text-muted">
                                    Finalisez votre transaction en toute sécurité.
                                </p>
                                <!-- Résumé de la commande -->
                                <div class="alert alert-light border mt-3 text-start">
                                    <p class="mb-1"><strong>Nom :</strong> {{ $data->first_name }} {{ $data->last_name }}
                                    </p>
                                    <p class="mb-1"><strong>Email :</strong> {{ $data->email }}</p>
                                </div>
                                <!-- Choix du mode de paiement -->
                                <div class="card mt-4 shadow-sm border-1">
                                    <div class="card-body">
                                        <div class="form-check mb-3 text-start">
                                            <input class="form-check-input" type="radio" name="installments_count"
                                                id="one_time" value="1" checked>
                                            <label class="form-check-label" for="one_time">
                                                <i class="bi bi-cash-coin me-2 text-success"></i>
                                                Paiement unique <br>
                                                <small class="text-dark">Régler la totalité :
                                                    <strong>{{ $data->totalPrice }} {{ $data->cartCurrency }}</strong> <span
                                                        class="text-secondary"> (@if ($data->cartCurrency == 'XAF')
                                                            {{ App\Utility\Utility::specific_currency_convert('EUR', $data->totalPrice) }}
                                                            EUR)
                                                        @endif
                                                    </span>
                                                </small>
                                            </label>
                                        </div>

                                        <div class="form-check text-start">
                                            <input class="form-check-input" type="radio" name="installments_count"
                                                id="installments" value="3">
                                            <label class="form-check-label" for="installments">
                                                <i class="bi bi-calendar3 me-2 text-primary"></i>
                                                Paiement en 3 tranches mensuelles <br>
                                                <small class="text-dark ms-4">3 ×
                                                    <strong>{{ number_format($data->totalPrice / 3, 0, ',', ' ') }}
                                                        {{ $data->cartCurrency }}</strong> <span class="text-secondary"> (
                                                        @if ($data->cartCurrency == 'XAF')
                                                            {{ App\Utility\Utility::specific_currency_convert('EUR', $data->totalPrice / 3) }}
                                                            EUR/mois)
                                                        @endif
                                                    </span></small>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Champs cachés -->
                                <input type="hidden" name="totalPrice" value="{{ $data->totalPrice }}">
                                <input type="hidden" name="currency" value="{{ $data->cartCurrency }}">
                                <input type="hidden" name="first_name" value="{{ $data->first_name }}">
                                <input type="hidden" name="last_name" value="{{ $data->last_name }}">
                                <input type="hidden" name="email" value="{{ $data->email }}">
                                <input type="hidden" name="phone" value="{{ $data->phone }}">
                                <input type="hidden" name="country" value="{{ $data->country }}">
                                <input type="hidden" name="post_code" value="{{ $data->postCode }}">
                                <input type="hidden" name="town" value="{{ $data->town }}">
                                <input type="hidden" name="quarter" value="{{ $data->quarter }}">
                                <input type="hidden" name="notes" value="{{ $data->notes }}">

                                <!-- Bouton -->
                                <button class="btn btn-primary btn-lg w-100 mt-3" style="border-radius: 30px;">
                                    ✅ Valider la transaction
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br><br>
@endsection
