@extends('frontend.main_master')

@section('title')
    AgenceDigitals | Confirmer la transaction
@endsection

@section('content')
    <!--=====================================
    Checkout
    ======================================-->
    <br><br>
    <div class="ps-checkout ps-section--shopping">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-body text-center p-4">

                            <h4 class="mb-3" style="font-weight: bold; color: #333;">
                                ✅ Finaliser votre Commande
                            </h4>
                            <p class="text-muted mb-4 h6">
                                Renouvellement <strong>100 % gratuit</strong> — aucun paiement ne vous sera demandé.
                            </p>

                            <form action="{{ url('/free/cash/order') }}" method="post">
                                @csrf

                                <!-- Champs cachés -->
                                <input type="hidden" name="total_amount" value="{{ $total }}">
                                <input type="hidden" name="subscription_id" value="{{ $data->subscriptionId }}">
                                <input type="hidden" name="name" value="{{ $data->name }}">
                                <input type="hidden" name="email" value="{{ $data->email }}">
                                <input type="hidden" name="phone" value="{{ $data->phone }}">
                                <input type="hidden" name="country" value="{{ $data->country }}">
                                <input type="hidden" name="post_code" value="{{ $data->postCode }}">
                                <input type="hidden" name="town" value="{{ $data->town }}">
                                <input type="hidden" name="quarter" value="{{ $data->quarter }}">
                                <input type="hidden" name="notes" value="{{ $data->notes }}">

                                <!-- Bouton -->
                                <button class="btn btn-success btn-lg mt-3 px-5 p-2" style="border-radius: 5px;">
                                    Terminer la transaction
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
